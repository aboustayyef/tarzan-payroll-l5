<div class="col-md-6">
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        <label for="date" class="control-label">Pick a date in the month for which this payroll is to be made</label>
        <input class="form-control" placeholder="dd/mm/yyyy" name="date" type="text" id="date" value="{{old('date', $period->date)}}">
        <small class="text-danger">{{ $errors->first('date') }}</small>
    </div>
    <div class="form-group">
        <label for="has_basic_rate" class="control-label">Does this month have a Basic Rate?</label>
        <select class="form-control" name="has_basic_rate" id="has_basic_rate">
            <option value="0" @if($period->has_basic_rate == 0 || old('has_basic_rate') == 0) selected @endif>No</option>
            <option value="1" @if($period->has_basic_rate == 1 || old('has_basic_rate') == 1) selected @endif>Yes</option>
        </select>
    </div>
</div>