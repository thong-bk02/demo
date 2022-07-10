@extends('layouts.app')

@section('content')
    <div class="container">
            <h2 class="text-center">
                Thêm Chấm công
            </h2>
            <form action="" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nhân sự</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="">
                        </div>
                        <div class="form-group">
                            <label for="">Ngày bắt đầu</label>
                            <input type="date" class="form-control" name="start_date" 
                                placeholder="" value="">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Tổng số ngày làm</label>
                            <input type="text" class="form-control" name="address"
                                value="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Số lần về sớm</label>
                            <input type="number" class="form-control" name="arrive_late"
                                placeholder="" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng số giờ về sớm</label>
                            <input type="number" class="form-control" name="hours_late"
                                placeholder="" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Số lần đi muộn</label>
                            <input type="number" class="form-control" name="leave_early"
                                placeholder="" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng số giờ đi muộn</label>
                            <input type="email" class="form-control" name="hours_early"
                                placeholder="" value="">
                        </div>
                    </div>
                </div>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                    <a href="{{ route('admin.timekeeping') }}" class="btn btn-secondary mx-3">Thoát</a>
                </div>

            </form>
    </div>
@endsection
