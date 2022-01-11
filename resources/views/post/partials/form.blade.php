<div class="form-group">
    @error('title')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <input class="form-control" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}" placeholder="Title">
</div>
<div class="form-group">
    @error('content')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <textarea class="form-control" name="content" cols="30" placeholder="Content" rows="10">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>