<div class="modal fade" id="see" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">All ingredients</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <div class="row">
                            @foreach ($recipe->ingredientsGet() as $ingredient)
                                <div class="col-12 text-center col-md-4">
                                    <img src="/img/ingredients/{{ $ingredient->thumbnail }}" class="image-look img-fluid" alt="Recipe">
                                </div>
                                <div class="col-12 col-md-5">
                                    <h5>Name: {{ $ingredient->name }}</h5>
                                    <p>Description: {{ $ingredient->description }}</p>
                                </div>
                                <div class="col-12 col-md-3">
                                    <p>Calories: <span class="font-weight-bold">{{ $ingredient->calorie }}</span></p>
                                </div>
                                <hr class="w-100">
                            @endforeach
                        </div>
                </div> 
            </form>
        </div>
    </div>
</div>