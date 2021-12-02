<div class="panel panel-primary">
    <div class="card-header py-3 bg-dark">
        <h6 class="m-0 font-weight-bold text-white">

            <i class="fa fa-question-circle"></i> HISTORIAL DE DOCENTES
        </h6>
    </div>

</div>

<div class="card-body bg-white">
    SELECCIONAR PERIODO:
    <select name="" id="listadocente" onchange="listaencuestadocente(this.value)">
        @foreach ($encuestax as $encu)

            <option>{{ $encu->sem_iCodigo }}</option>

        @endforeach
    </select>
    <div id="tdocentes">
        lista  de categorias
    </div>
    <div id="tpreguntas">

    </div>