<div class="card shadow mb-4">
    <div class="card-header py-3 bg-info">
        <h6 class="m-0 font-weight-bold ">

            <a class="btn btn-info  btn-lg" style="background-color: black">1</a> Nota: Subir una copia del voucher(máx
            4MB). Puede ser un archivo de imagen o pdf.
        </h6>
        <!--        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                src="img/undraw_posting_photo.svg" alt="..."> //-->


    </div>
    <table>
        <tr>
            <td>
               
                <div class="card-body">
                    <i class="fas fa-file-alt fa-6x"></i><br>
                    <form action="../pagosmatriculax" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                        <input id="codalumno" name="codalumno" type="hidden" value="{{ $codalumno }}">
                        <input id="semestre" name="semestre" type="hidden" value="{{ $semestreactual }}">
                        <input id="tipox" name="tipox" type="hidden" value="MATRICULA">
                        <span class="icon text-dark-50">
                            <br>
                            <button type="submit" class="btn btn-success ">
                                <i class="fas fa-check"></i>
                                <span class="text">Subir</span>
                            </button>Solo archivos JPG o PDF
                    </form>
                </div>
            </td>
            <td>
                <p>
                <h3>Pago por matrícula - MATRICULA INGRESANTE</h3>
                <p>Por el tipo de matrícula que le corresponde, usted debe realizar el pago de S/. 25.00. Puede realizar
                    el deposito de la siguiente manera:</p>
                <ul>
                    <li>00461026176 Cuenta UNAAT pago en Agentes Banco de la Nación</li>
                    <li>0461026176 Cuenta UNAAT pago en Banco de la Nación</li>
                </ul>
                <p>Si tuviera alguna duda comuniquese con Enc. Caja. José Yapias, Num.Cel. 949 985 381</p>
                <strong style="font-style: italic;">Horarios de Atención: Lun a Vie. 08:00 am a 01:00 pm | 03:00 pm a
                    06:00 pm</strong>
                </p>
            </td>
        </tr>
    </table>



</div>
