<div>
    <div class="m-3 p-3 ">
        <label class="form-label">توضیح:</label>
        <textarea  name="description" class="form-control"></textarea>
    </div>
    <div>
        <label class="form-label">:دسته بندی</label>
        <select name="category_id" class="form-control px-5">
            @foreach($Categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="m-3 p-3">
        <label class="form-label">جمع بندی:</label>
        <textarea name="summation" class="form-control"></textarea>
    </div>
    <button class="btn btn-warning" type="submit">{{$buttonName}}</button>
</div>
