<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="title" class="col-md-2 control-label">
                Title
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" autofocus
                       id="title" value="{{ $title }}">
            </div>
        </div>

        <div class="form-group">
            <label for="subtitle" class="col-md-2 control-label">
                Subtitle
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="subtitle"
                       id="subtitle" value="{{ $subtitle }}">
            </div>
        </div>

        <div class="form-group">
            <label for="content" class="col-md-2 control-label">
                Content
            </label>
            <div class="col-md-10">
        <textarea class="form-control" name="content" rows="14"
                  id="content">{!! $content !!}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-4">

        <div class="form-group">
            <label for="is_draft" class="col-md-3 control-label">

            </label>
            <div class="col-md-8">
                <div class="checkbox checkbox-primary">
                    <input id="is_draft" type="checkbox" name="is_draft" {{ checked($is_draft) }}>
                    <label for="is_draft">Draft?</label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="categories" class="col-md-3 control-label">
                Categories
            </label>
            <div class="col-md-8">
                <select name="categories[]" id="categories" class="form-control" multiple>
                    @foreach ($allCategories as $category)
                        <option @if (in_array($category, $categories)) selected @endif
                        value="{{ $category['category'] }}">
                            {{ $category['category'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="tags" class="col-md-3 control-label">
                Tags
            </label>
            <div class="col-md-8">
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach ($allTags as $tag)
                        <option @if (in_array($tag, $tags)) selected @endif
                        value="{{ $tag['tag'] }}">
                            {{ $tag['tag'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <input type="hidden" class="form-control" name="layout"
               id="layout" value="{{ $layout }}">


        <div class="form-group" style="display:none;">
            <label for="meta_description" class="col-md-3 control-label">
                Meta
            </label>
            <div class="col-md-8">
        <textarea class="form-control" name="meta_description"
                  id="meta_description"
                  rows="6">{{ $meta_description }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="meta_description" class="col-md-3 control-label">
                Main Image
            </label>
            <div class="col-md-8">
                <div class="dropzone" id="main_image_upload">
                    <div class="dz-message" data-dz-message><span>Add Image</span></div>
                </div>
                <input type="hidden" name="page_image" value="">
            </div>

        </div>


        <div class="form-group">
            <label for="meta_description" class="col-md-3 control-label">
                Promotion Image
            </label>
            <div class="col-md-8">
                <div class="dropzone" id="promo_main_image">
                    <div class="dz-message" data-dz-message><span>Add Promotion Image</span></div>
                </div>
                <input type="hidden" name="promo_image" value="">
            </div>

        </div>

        <div class="form-group">
            <label for="publish_date" class="col-md-3 control-label">
                Pub Date
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_date" id="publish_date"
                       type="text" value="{{ $publish_date }}">
            </div>
        </div>
        <div class="form-group">
            <label for="publish_time" class="col-md-3 control-label">
                Pub Time
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_time" id="publish_time"
                       type="text" value="{{ $publish_time }}">
            </div>
        </div>

    </div>
</div>