<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    /* Query Scopes */
    public function scopeTitle(Builder $query, string $title) : Builder {
        return $query->where('title','LIKE','%'. $title .'%');
    }

    public function scopeCreatedInPeriod(Builder $query, string $startDate, string $endDate = null) : Builder {
        if (empty($endDate)){
            $endDate = Carbon::now()->timezone(new \DateTimeZone('Asia/Riyadh'));
            echo $endDate;
        }
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
    
    public function scopeRecentlyAddedBooks(Builder $query){
        return $query->orderBy('created_at','desc')
                ->take(10)
                ->withCount('reviews');
    }

    public function scopePopularBooks(Builder $query, string $startDate = null, string $endDate = null) : Builder {
        return $query
                ->withCount(['reviews' => fn(Builder $q) =>  $this->filterReviewsBasedOnCreationDate($q, $startDate,  $endDate)])
                ->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRatedBooksInPeriod(Builder $query, string $startDate, string $endDate = null) : Builder {
        return $query
                ->withAvg(['reviews' => fn(Builder $q) => $this->filterReviewsBasedOnCreationDate($q, $startDate, $endDate)], 'rating')
                ->orderBy('reviews_avg_rating','desc');
    }

    private function filterReviewsBasedOnCreationDate(Builder $query, string $startDate, string $endDate) {
        if ($startDate && !$endDate) {
            $query->where('created_at','>=', $startDate);
        }
        else if (!$startDate && $endDate){
            $query->where('created_at','<=', $endDate);
        }
        else if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    }
}
