<div class="flex flex-row">
    <p class="mr-1"><span class="text-slate-700 font-semibold">{{ $rating }}</span> | </p>
    <p class="mr-1">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $rating)
                ★
            @elseif ($rating > $i - 1 && $rating < $i)
                ½
            @else
                ☆
            @endif
        @endfor
    </p>
</div>
