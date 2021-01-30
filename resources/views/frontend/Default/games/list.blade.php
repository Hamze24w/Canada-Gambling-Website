@extends('frontend.Default.layouts.app')
@section('slider')
<section id="hero-section">
    <iframe style="overflow:hidden !important; height:370px; padding:0px !important; margin:0px !important; border: none !important;" width="100%" src="http://canada777.com/slides/slide.php" allowfullscreen scrolling="no"></iframe>
</section>
@endsection
@section('content')
<section id="game-list">
    <!-- GAMES - BEGIN -->
    <div class="section-title">
        <h3>{{$currentListTitle}} Games</h3>
    </div>
    <div class="game-category-section">
        <div class="section-content" id="section-game">
        @if ($games && count($games))
            @foreach ($games as $key=>$game)
            <div class="game-item">
                <img data-original="{{asset('frontend/Default/ico/')}}/{{$game->name.'.jpg'}}" />
                <div class="game-overlay">
                    <a href="{{ route('frontend.game.go', $game->name) }}">Play For Real</a>
                    <a href="#">Play For Fun</a>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
    <div style="text-align: center; margin: 20px;">
        <button id="btn_loadmore_game" onclick="fn_loadmore('GAME','{{$currentListTitle}}')" class="btn btn-outline-secondary btn-lg">Load More</button>
    </div>
    @if($currentSliderNum != "hot")
    <div class="section-title">
        <h3>Hot Games</h3>
    </div>
    <div class="game-category-section">
        <div class="section-content" id="section-hot">
        @if ($hotgames && count($hotgames))
            @foreach ($hotgames as $key=>$hotgame)
            <div class="game-item">
                <img data-original="{{asset('frontend/Default/ico/')}}/{{$hotgame->name.'.jpg'}}" />
                <div class="game-overlay">
                    <a href="{{ route('frontend.game.go', $hotgame->name) }}">Play For Real</a>
                    <a href="#">Play For Fun</a>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
    <div style="text-align: center; margin: 20px;">
        <button id="btn_loadmore_hot" onclick="fn_loadmore('HOT')" class="btn btn-outline-secondary btn-lg">Load More</button>
    </div>
    @endif
    @if($currentSliderNum != "new")
    <div class="section-title">
        <h3>New Games</h3>
    </div>
    <div class="game-category-section">
        <div class="section-content" id="section-new">
        @if ($newgames && count($newgames))
            @foreach ($newgames as $key=>$newgame)
            <div class="game-item">
                <img data-original="{{asset('frontend/Default/ico/')}}/{{$newgame->name.'.jpg'}}" />
                <div class="game-overlay">
                    <a href="{{ route('frontend.game.go', $newgame->name) }}">Play For Real</a>
                    <a href="#">Play For Fun</a>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
    <div style="text-align: center; margin: 20px;">
        <button id="btn_loadmore_new" onclick="fn_loadmore('NEW')" class="btn btn-outline-secondary btn-lg">Load More</button>
    </div>
    @endif
</section>
@endsection
@section('page_bottom')
<script>
    var page_hot = 0;
    var page_new = 0;
    var page_game = 0;
    fn_loadmore=(type, category)=>{
        if(type == "HOT"){
            page_hot++;
        }
        else if(type == "NEW"){
            page_new++;
        }
        else if(type == "GAME"){
            page_game++;
        }
        $.ajax({
            url:"{{ route('frontend.loadmore.game') }}",
            type:"GET",
            data:{
                pagehot:page_hot,
                pagenew:page_new,
                pagegame:page_game,
                type:type,
                category:category
            },
            dataType:"JSON",
            success:(data)=>{
                var games = data.result;
                var section_game = "";
                
                if(games.length == 0){
                    alert("data empty");
                    return;
                }
                    
                for(var i=0;i<games.length;i++) {
                    section_game+=  '<div class="game-item">\
                                            <img src="/frontend/Default/ico/'+games[i].name+'.jpg" data-original="/frontend/Default/ico/'+games[i].name+'.jpg" data-image-blur-on-load-update-occured="true" style="filter: opacity(1);"/>\
                                            <div class="game-overlay">\
                                                <a href="/game/'+games[i].name+'">Play For Real</a>\
                                                <a href="#">Play For Fun</a>\
                                            </div>\
                                        </div>';
                }
                switch (data.type) {
                    case "HOT":
                        $("#section-hot").append(section_game);  
                        break;
                    case "NEW":
                        $("#section-new").append(section_game);  
                        break;
                    case "GAME":
                        $("#section-game").append(section_game);  
                        break;
                    default:
                        break;
                }
                                      
            },
            error:()=>{
                alert("error");
            }
        });   
    }
</script>
@endsection
