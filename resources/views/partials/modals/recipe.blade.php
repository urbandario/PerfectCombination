<div class="modal fade" id="see" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ $training->recipe()->first()->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center col-md-4">
                            <img src="/img/recipes/{{ $training->recipe()->first()->thumbnail }}" class="image-look img-fluid" alt="Recipe">
                            <button type="button" title="See all ingredients" class="btn btn-success text-black-50 mt-3" data-dismiss="modal" data-toggle="modal" style="width: 50px" onclick="seeIngredients({{ $training->recipe()->first()->id}})"><i class="fas fa-carrot"></i></button>

                        </div>
                        <div class="col-12 col-md-5">
                            <h5>Name: {{ $training->recipe()->first()->name }}</h5>
                            <p>Description: {!! $training->recipe()->first()->way_of_making !!}</p>
                        </div>
                        <div class="col-12 col-md-3">
                            Total amount of calories: <span class="font-weight-bold">~ {{ $training->recipe()->first()->totalCalories() }} kcal</span>
                        </div>
                        <hr class="w-100">
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>