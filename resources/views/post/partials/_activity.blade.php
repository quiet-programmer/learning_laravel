<div class="container">
    <div class="row">
        @card([
        'title' => 'Most Commented',
        'subtitle' => 'What people are currently talking about.',
        'items' => $mostCommented,
        'value' => 'title',
        'show' => true
        ])
        @endcard
    </div>
    <div class="row mt-4">
        @card([
        'title' => 'Most Active',
        'subtitle' => 'Users with most post written',
        'items' => $mostActive,
        'value' => 'name',
        'show' => false
        ])
        @endcard
    </div>

    <div class="row mt-4">
        @card([
        'title' => 'Most Active Last Month',
        'subtitle' => 'Users with most post written last month',
        'items' => $mostActiveLastMonth,
        'value' => 'name',
        'show' => false
        ])
        {{-- @slot('items', collection(mostActiveLastMonth)->plucl('name')) --}}
        @endcard
    </div>
</div>