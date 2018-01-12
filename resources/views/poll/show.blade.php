<h2>Опитування:</h2>
@if(!empty($polls))
    @foreach($polls as $poll)
        <p>{{ $poll->question ?? '' }}</p>
    @endforeach
    @if(is_object($polls) && !empty($polls->lastPage()) && $polls->lastPage() > 1)

        {{--@if($polls->lastPage() != $polls->currentPage())
            <div class="main-buty load-more" data-source="1" @if(!empty($cat->id)) data-id="{{ $cat->id}} @endif">
                <a href="" onclick="return false">Завантажити ще<span class="linn"></span></a>
            </div>
            <input type="hidden" name="stats">
        @endif--}}
        {{--Pagination--}}
        <div class="polls-pagination">
            @if($polls->lastPage() > 1)
                @if($polls->currentPage() !== 1)
                    <a href="{{ $polls->url(($polls->currentPage() - 1)) }}" class="forward-back"></a>
                @endif
                @if($polls->currentPage() >= 3)
                    <a href="{{ $polls->url($polls->url(1)) }}" class="pagin-number">1</a>
                @endif
                @if($polls->currentPage() >= 4)
                    <a>&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;</a>
                @endif
                @if($polls->currentPage() !== 1)
                    <a href="{{ $polls->url($polls->currentPage()-1) }}"
                       class="pagin-number">{{ $polls->currentPage()-1 }}</a>
                @endif
                <a class="active-pagin-number pagin-number">{{ $polls->currentPage() }}</a>
                @if($polls->currentPage() !== $polls->lastPage())
                    <a href="{{ $polls->url($polls->currentPage()+1) }}"
                       class="pagin-number">{{ $polls->currentPage()+1 }}</a>
                @endif
                @if($polls->currentPage() <= ($polls->lastPage()-3))
                    <a>&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;</a>
                @endif
                @if($polls->currentPage() <= ($polls->lastPage()-2))
                    <a href="{{ $polls->url($polls->lastPage()) }}"
                       class="pagin-number">{{ $polls->lastPage() }}</a>
                @endif
                @if($polls->currentPage() !== $polls->lastPage())
                    <a rel="next" href="{{ $polls->url(($polls->currentPage() + 1)) }}"
                       class="forward"></a>
                @endif

            @endif
        </div>
    @endif
@endif