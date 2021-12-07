<div class="card shadow mb-4">
    <div class="card-header py-3 bg-info">
        <h6 class="m-0 font-weight-bold">

            <a class="btn btn-dark  btn-lg" style="background-color: black">2</a> CARNET UNIVERSITARIO<br> Nota: Subir
            una copia del voucher(máx 4MB). Puede ser un archivo de imagen o pdf.
        </h6>
        <!--        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                src="img/undraw_posting_photo.svg" alt="..."> //-->


    </div>
    <div class="card-body">
        <i class="fas fa-file-alt fa-6x"></i><br>
        <form action="docente" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="file" name="file" type="file" class="file" data-show-preview="false">
            <input id="coddoc" name="coddoc" type="hidden" value="{{ $codalumno }}">
            <span class="icon text-dark-50">
                <br>
                <button class="btn btn-success ">
                    <i class="fas fa-check"></i>
                    <span class="text">Subir</span>
                </button>Solo archivos JPG o PDF
        </form>
    </div>
</div>
