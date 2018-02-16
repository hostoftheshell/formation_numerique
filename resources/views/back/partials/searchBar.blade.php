<div class="col-2 col-md-offset-8">
<form action="{{route('back.search')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Rechercher parmi tous les articles">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-eye-open"></span>
            </button>
        </span>
    </div>
    </form>
</div>