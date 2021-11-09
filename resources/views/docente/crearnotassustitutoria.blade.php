<script>
function color(t)
{ t.style.color='red';}
</script>
<style>
    .table th,table td
    {  font-size: .80em;

    }
    .input{
        max:2;
        size:2;
    }
    </style>
<div class="card mb-4">
    <div class="card-header bg-Info text-black" style='background-color:rgb(88, 25, 236);color:white;'>
    Actualizacion Notas Sustitoria
    </div>
    <div class="card-body">
    <div style="overflow: scroll;">                               
    <table class="table table-striped table-bordered table-sm " cellspacing="0"
       id="dataTable"   >
    <thead>
    <tr style='background-color:navy;color:white;'>
    <td>#</td>
    <td>Codigo</td>
    <td>Nombre</td>
    <td>PU1</td>
    <td>Prom</td>
    <td>Sust</td>
    <td>Action</td>
    <td>Aplaz.</td>
    <td>NF</td>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>1</td>
    <td>20216OA</td>
    <td>ASTUVILCA MIGUEL JOSELYN SHARON</td>
    <td>10</td>
    <td>-</td>
    <td><input type="text" name="x1" id="x1" size=2></td>
    <td><a class="btn btn-danger " id="bnotassustitoriocurso">Borrar</a></td>
    <td>-</td>
    <td>10</td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    

    <script src="{{ asset('ohsnap/ohsnap.js')}}"></script>
   
    <style>
       

        .alert {
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid #eed3d7;
  border-radius: 4px;
  position: absolute;
  bottom: 0px;
  right: 21px;
  /* Each alert has its own width */
  float: right;
  clear: right;
  background-color: #DA4453;
}

    </style>
     <div id="ohsnap" ></div>
<script>
function vermensaje()
{
 
ohSnap('REGISTRANDO', {'duration':'1500'});  // 2 seconds


}
//vermensaje()
</script>
<a class="button" id="green" onclick="vermensaje()"><span>Success</span></a>