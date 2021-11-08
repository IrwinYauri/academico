<div class="card shadow mb-8" style="overflow: scroll;">
    <div class="card-header py-8">
    <h6 class="m-0 font-weight-bold text-primary">
      CARRERA:<select>
        <option>ENFERMERIA</option>
        <option>INGERIA AGROINDUSTRIAL</option>
        </select><br>
        CICLO:<select>
          <option>I</option>
          <option>II</option>
          <option>III</option>
          <option>IV</option>
          </select><br>
    <i class="fa fa-table fa-2x " ></i> HORARIO - SEMANAL
    <button class="btn btn-success btn-sm">IMPRIMIR</button>
    </h6>
  </div>
  <div class="card-body">
  
    <table class='table table-striped table-hover table-responsive-md' width='80%'>
  <thead >
  <tr style='background-color:navy;color:white;'>
  <th>Hora</th><th>LUNES</th><th>MARTES</th><th>MIERCOLES</th><th>JUEVES</th><th>VIERNES</th></tr>
  </thead>
  <tbody>
    @for($x=1;$x<8;$x++)
    <tr>
    <td>0{{$x}}-</td>
      @for($n=1;$n<6;$n++)
    <td><select>
        <option>Curso</option>
        <option>FISICA</option>
        <option>MATEMATICA</option>
        <option>BIOLOGIA</option>
        <option>LENGUAJE I</option>
        </select><br>
        <select>
          <option>DOCENTE</option>
          <option>POCOY</option>
          <option>LAMAYA</option>
          <option>PEREZ</option>
          <option>POZO</option>
          </select>
          <select>
            <option>DICTADO</option>
            <option>TEORIA</option>
            <option>PRACTICA</option>
            
          </select>
      </td>
       @endfor
    </tr>
    @endfor
    
    
  </tbody>
  </table>
  </div>
  </div>