<section id="category-section">
    <div class="top-category-list">
        @if( settings('use_all_categories') )
        <a href="#" data-filter="all" class="filter-button">@lang('app.all')</a>
        @endif
        @if ($categories)
            @foreach($categories as $category)
                @if($category->position < 7)
                    <a href="#" class="filter-button" data-filter="{{$category->position}}">{{ $category->title }}</a>
                @endif
            @endforeach
        @endif
    </div>
    <div class="search-box">
        <input type="text" id="search_game" placeholder="Find Your Game" />
        <svg
        xmlns='http://www.w3.org/2000/svg'
        width='14'
        height='14'
        viewBox='0 0 14 14'
        >
        <path
        data-name='_ionicons_svg_ios-search (5)'
        d='M77.845,76.9l-3.9-3.932a5.553,5.553,0,1,0-.843.854l3.871,3.906a.6.6,0,0,0,.846.022A.6.6,0,0,0,77.845,76.9Zm-8.26-3.031a4.384,4.384,0,1,1,3.1-1.284A4.358,4.358,0,0,1,69.586,73.865Z'
        transform='translate(-64 -63.9)'
        fill='currentColor'
        />
    </svg>
    </div>
    <div class="category-toggle-button dropdown">
        <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">game provider</button>
        <div class="dropdown-menu dropdown-large">
            <ul>
                @if($categories)
                    @foreach($categories as $category)
                        @if($category->position >6)
                        <li><a href="#"  class="filter-button" data-filter="{{$category->position}}">{{ $category->title }}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</section>