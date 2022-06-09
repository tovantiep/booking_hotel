<div class="modal fade" id="modal-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Thêm số phòng</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select name="sophong" id="sophong" class="form-control">
                        <option value="" id="" selected disabled>-- Chọn mã đặt phòng --</option>  
                        {{-- @foreach ($sophong as $item)
                            <option value="{{ $item->id }}">Số phòng: {{ $item->so_phong }}</span></option>                            
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default btn-success btn-them" data-dismiss="modal" id="themsophong">Thêm</a>
            </div>
        </div>
    </div>
</div>
