
<label class="col-md-2 control-label">{{trans('orbscope.sub_category')}} </label>
    <div class="col-md-10">
        <select class="form-control select2-multiple" data-placeholder="{{trans('orbscope.sub_category')}}" id="multiple" name="sub_id[]" multiple>
            <option></option>
            @foreach($data as $city)
                <option value="{{$city->id}}">{{VarByLang($city->name,GetLanguage())}}</option>
            @endforeach
        </select>
    </div>