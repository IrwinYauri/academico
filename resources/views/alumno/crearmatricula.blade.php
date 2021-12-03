<style>
    .colorx {
        color: white;
		background-color: rgb(23, 23, 70);
    }

	.colorlista {
        color: white;
		background-color:rgb(44, 9, 9);
    }
	

</style>
<div class="card shadow mb-4">
	<div class="card-header py-3 colorx">

		<h5 class="m-0 font-weight-bold text-white">Requisitos para la Matrícula</h5>
	</div>
	<div class="card-body">
		<p>
			Según la evaluación del sistema. La condición del estudiante exige los siguiente requisitos:
		</p>
	
		<!-- fin card -->
	</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 colorx ">
        <h6 class="m-0 font-weight-bold text-white">
           DOCUMENTOS SOLICITADOS PARA MATRICULARSE
        </h6>
    </div>
    <div class="card-body">
        <table>
		<tr>
		<td><a href="" class="nav-link"> 1:Voucher de Matricula </a></td>
		<td><a href="" class="nav-link"> 2:Voucher de Carnet </a></td>
		<td><a href="" class="nav-link"> 3:Constancia del Seguro</a></td>
		<td><a href="" class="nav-link">  4:Ficha Socio Economica</a></td>
		<td rowspan="2"><a  class="btn btn-primary"> SELECCIONAR CURSOS</a></td>
	</tr>
		<tr>
			<td>
				<a href="#" class="btn btn-danger btn-circle " disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td>
			<td><a href="#" class="btn btn-danger btn-circle " disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td>
			<td><a href="#" class="btn btn-danger btn-circle "disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td>
			<td><a href="#" class="btn btn-danger btn-circle " disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td></tr>
		</table>
		

        <div style="display: none">
            <a href="#" class="btn btn-danger btn-circle ">
                <i class="fas circle"></i>
            </a> 2:Pendiente
            <a href="#" class="btn btn-danger btn-circle ">
                <i class="fas circle"></i>
            </a> 3:Pendiente
            <a href="#" class="btn btn-danger btn-circle ">
                <i class="fas circle"></i>
            </a> 4:Pendiente

            <a href="#" class="btn btn-success btn-circle btn-lg">
                <i class="fas fa-check"></i>
            </a> PROCESO DE MATRICULA Completado
        </div>

    </div>
</div>



    <!-- inicio card -->
    

    
	<div class="container">
		
			@include('alumno.matriculapagovoucher')
			<!-- fin matricu//-->
	
			@include('alumno.matriculacarnetvoucher')
			<!-- fin carnet//-->
	
			@include('alumno.matriculaseguroconstancia')
			<!-- fin cosntseguro//-->
		
			@include('alumno.matriculafichaeconomica')
			
			<!-- fin cosntseguro//-->
		</div>
	</div>
