<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add ingredient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" action="{{ route('create_ingredient') }}" id="multiple_select_form" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
    
                        <div class="row">
                            <div class="col-6">
                                <h5 for="name">Name</h5>
                                <input id="name" type="text" maxlength="32"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <small id="infoName" class="text-secondary"></small><br>
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <h5 for="calorie">Calorie</h5>
                                <input id="calorie" type="calorie" maxlength="32"  class="form-control @error('calorie') is-invalid @enderror" name="calorie" value="{{ old('calorie') }}" required autocomplete="calorie" autofocus>
    
                                @error('calorie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-6 ">
                                <h5 for="description" class="mt-3">Description</h5>
                                <textarea rows="4" , cols="54" class="form-control @error('description') is-invalid @enderror" name="description" id="description" required >{{ old('description') }}</textarea>
                                <small id="infoDescription" class="text-secondary"></small><br>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <h5>Add thumbnail: </h5><br/>
                                <input type="file" id="thumbnail" name="thumbnail"><br><br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </div> 
            </form>
        </div>
    </div>
</div>