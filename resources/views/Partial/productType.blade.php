<div class="col-sm-3">
    <ul class="aside-menu">
       @isset($product_type)
           @foreach ($product_type as $item)
           <li><a href="/type/{{$item->id}}">{{$item->name}}</a></li>
           @endforeach
       @endisset
    </ul>
</div>
{{-- <li class="is-active"><a href="#">Custom callout box</a></li> --}}