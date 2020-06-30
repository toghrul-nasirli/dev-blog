<div class="col-md-4 mt-3">
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row text-nowrap">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        @foreach ($categories->skip(0)->take(3) as $category)
                            <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        @foreach ($categories->skip(3)->take(3) as $category)
                            <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-4">
        <h5 class="card-header">Tags</h5>
        <div class="card-body">
            <div class="row text-nowrap">
                <div class="col-lg-3">
                    <ul class="list-unstyled mb-0">
                        @foreach ($tags->skip(0)->take(3) as $tag)
                            <li><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3">
                    <ul class="list-unstyled mb-0">
                        @foreach ($tags->skip(3)->take(3) as $tag)
                            <li><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3">
                    <ul class="list-unstyled mb-0">
                        @foreach ($tags->skip(6)->take(3) as $tag)
                            <li><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3">
                    <ul class="list-unstyled mb-0">
                        @foreach ($tags->skip(9)->take(3) as $tag)
                            <li><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>