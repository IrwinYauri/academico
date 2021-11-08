@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }


@endphp
<style>
  .td,th,tr{
    color:black;
    text-transform: uppercase;
  }
</style>
<div class="card mb-4">
<div class="card-header text-black" style="background-color: navy;color:white">
CAMBIAR CONTRASEÑA
</div>
<div class="card-body">
<div style="overflow: none;">                               
<table class="table table-striped table-bordered table-sm " cellspacing="0"
   id="dataTable"  width="70%" >

<tr>
<td>Contraseña anterior</td>
<td>
  <input type="hidden" id="n1" name="n1" value="{{$coddocentex}}">
  <input type="password" id="n2" name="n2"></td>
</tr>
<tr>
<td>Contraseña Nueva</td>
<td><input type="password" id="n3" name="n3"></td>
</tr>

<tr>
<td colspan="2" >
  <button class="btn btn-danger " id="buttonID2" onclick="procesarpass('n1','n2','n3')" type="button"> 
    <i class="fas fa-check" ></i> MODIFICAR</button>

</td>

</tr>
</tbody>
</table>
</div>
</div>
</div>


                    
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sms" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title " id="exampleModalLongTitle">SisAcademico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <i class="fas fa-desktop fa-2x"   ></i>  Actualizacion Completada
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Grabar</button>
      </div> //--->
    </div>
  </div>
</div>

<div id="micontenido11" style="display: none">

</div>
<div id="mimensajex">GRABANDO</div>

<script>
 function vermensaje(){
  $('#exampleModalLong').modal('toggle');
            setTimeout(function() {
            //    $('#exampleModalLong').modal('toggle');
                $('#exampleModalLong').modal('hide')
            }, 3000);
        }
  function procesarpass(n1,n2,n3)
  {  
    x1=document.getElementById(n1).value;
    x2=document.getElementById(n2).value;
    x3=document.getElementById(n3).value;
    //alert(x1);
    //alert(x2);
    //alert(x3);
    buscarpassword(x1,x2,x3);
  }
</script>
