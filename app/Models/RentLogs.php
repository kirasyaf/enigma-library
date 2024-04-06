<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentLogs extends Model
{
    use HasFactory;

    protected $table = 'rent_logs';

    protected $fillable = [
        'user_id', 'book_id', 'rent_date', 'return_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function calculateFine(): int
    {
        if ($this->actual_return_date && $this->actual_return_date > $this->return_date) {
            $days_overdue = strtotime($this->actual_return_date) - strtotime($this->return_date);
            $days_overdue = floor($days_overdue / (60 * 60 * 24)); // Convert to days

            // Fine calculation
            $fine = $days_overdue * 1000;

            // Update fine in the database
            DB::table('rent_logs')
                ->where('id', $this->id)
                ->update(['fine' => $fine]);

            return $fine;
        } else {
            // Reset fine to 0 if no overdue
            DB::table('rent_logs')
                ->where('id', $this->id)
                ->update(['fine' => 0]);

            return 0;
        }
    }
}