<div class=" rounded-1 bg-green-two p-3">
    <h3 class="text-center fw-bolder"> :) اضافه کردن پلن جدید</h3>
    <div class="m-3 p-2">
        <label class="form-label ">توضیح:</label>
        <textarea name="description" class="form-control">{{$plan->description}}</textarea>
        @if($errors->first('description'))
            <p class="text-danger fw-bolder">{{$errors->first('description')}}</p>
        @endif
    </div>
    <div class="mx-2 px-2">
        <label class="form-label ">:دسته بندی</label>
        <select name="category_id" class="form-control px-5">
            @foreach($Categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @if($errors->first('category_id'))
            <p class="text-danger fw-bolder">{{$errors->first('category_id')}}</p>
        @endif
    </div>
    <div class="m-3">
        <label class="form-label ">جمع بندی:</label>
        <textarea name="summation" class="form-control" placeholder="جمع بندی ...">{{$plan->summation}}</textarea>
        @if($errors->first('summation'))
            <p class="text-danger fw-bolder">{{$errors->first('summation')}}</p>
        @endif
    </div>
    <div class="text-center">
        <button class="btn bg-yellow px-5" type="submit">{{$buttonName}}</button>
    </div>

</div>
