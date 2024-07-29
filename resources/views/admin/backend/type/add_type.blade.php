@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body" bis_skin_checked="1">

                            <h6 class="card-title">Add Service Type</h6>

                            <form class="forms-sample" action="{{ route('store.type') }}" method="POST">
                                @csrf
                                <div class="mb-3" bis_skin_checked="1">
                                    <label for="exampleInputUsername1" class="form-label">Service Name</label>
                                    <input type="text" class="form-control @error('type_name') is-invalid @enderror"
                                        name="type_name" id="type_name" autocomplete="off">
                                    @error('type_name')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3" bis_skin_checked="1">
                                    <label for="exampleInputUsername1" class="form-label">Service Type Icon</label>
                                    <input type="text" class="form-control @error('type_icon') is-invalid @enderror"
                                        name="type_icon" id="type_icon" autocomplete="off">
                                    @error('type_icon')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3" bis_skin_checked="1">
                                    <label for="exampleInputUsername1" class="form-label">Parant Service Type</label>
                                    <select class="form-select @error('type_parent') is-invalid @enderror" id="type_parent"
                                        name="type_parent">
                                        <option selected="" disabled="">Select Parent Serice</option>
                                        <option value="none">None</option>
                                    </select>
                                    @error('type_name')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3" bis_skin_checked="1">
                                    <label for="exampleInputUsername1" class="form-label">Service Desription</label>
                                    <textarea class="form-control @error('type_description') is-invalid @enderror" name="type_description"
                                        id="exampleFormControlTextarea1" rows="4" spellcheck="false"></textarea>
                                    @error('type_description')
                                        <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->

        </div>

    </div>
@endsection
