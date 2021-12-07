<div class="card">


    <!--?= $this->render("//comun/alerta") ?-->

    <div class="card-header colorlista">
        <h1> <a class="btn btn-dark  btn-lg" style="background-color: black">4</a>   
            FICHA SOCIO ECONÓMICA</h1>
    </div>
    
    <div class="card-body">

    <h5 style="text-align: justify;">Estimado Estudiante: El presente documento tiene como
        finalidad conocer algunos aspectos socio económicos de quienes son parte de nuestra
        comunidad universitaria, por ello te solicitamos que completes la siguiente información
        con carácter de Declaración Jurada, en caso de brindar información falsa se procederá a
        gestionar la sanción correspondiente de acuerdo a ley.</h5>
    <form id="seguro-form" action="/unaatalumno/web/matricula/fichasocioeconomica" method="post"
        enctype="multipart/form-data">
        <input type="hidden" name="_csrf"
            value="1vCkxBocLCWxMVAXlnhRYyCsqQg7lukihHYYsE5viuHlg8Crb25UFPYCD3PPLjwqVM_NfHTVhVfBMVaGHiDmsw==">
        <input type="hidden" name="codigo" value="">
        <div class="panel-group">

            <div class="panel panel-primary">
                <div class="panel-heading">I. DATOS GENERALES DEL ESTUDIANTE</div>

                <div class="cuadro">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Apellidos y nombres:</label>
                            <input type="text" class="form-control" name="anom" id="anom"
                                readonly="readonly" value="RITO BOB LUCAS" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Lugar de Nacimiento</label>
                            <select class="form-control" name="lnac" id="lnac">
                                <option value=""> > > </option>
                                <option value="010101">AMAZONAS > CHACHAPOYAS > CHACHAPOYAS
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Celular</label>
                            <input type="number" class="form-control" name="numCEl"
                                id="numCEl" value="" step="1" min="0" max="1000000000" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Estado Civil</label>
                            <select class="form-control" name="eCiv" id="eCiv">
                                <option value="SOLTERO">SOLTERO</option>
                                <option value="CASADO">CASADO</option>
                                <option value="CONVIVIENTE">CONVIVIENTE</option>
                                <option value="VIUDO">VIUDO</option>
                                <option value="DIVORSIADO">DIVORSIADO</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Correo Electrónico</label>
                            <input type="email" class="form-control" name="cElec" id="cElec"
                                maxlength="64" placeholder="xyz@abc.com" value="" required>
                        </div>
                        <div class="col-sm-2">
                            <label>núm.Hijo(s)</label>
                            <input type="number" class="form-control" name="numHij"
                                id="numHij" value="0" placeholder="" step="1" min="0" max="100"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>¿En que tipo de lugar vive actualmente?</label>
                            <select class="form-control" name="tlva" id="tlva">
                                <option value="FAMILIAR">FAMILIAR</option>
                                <option value="CUARTO ALQUILADO">CUARTO ALQUILADO</option>
                                <option value="PARIENTE">PARIENTE</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Dirección</label>
                            <input type="text" class="form-control" name="direccion"
                                id="direccion" value="" placeholder="" maxlength="250" required>
                        </div>
                        <div class="col-sm-4">
                            <label>¿En qué lugar vive actualmente?</label>
                            <select class="form-control" name="luvivact" id="luvivact">
                                <option value=""> > > </option>
                                <option value="010101">AMAZONAS > CHACHAPOYAS > CHACHAPOYAS
                                </option>
                                <option value="250401">UCAYALI > PURUS > PURUS</option>

                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Referencia</label>
                            <input type="text" class="form-control" name="refe" id="refe"
                                value="" placeholder="" maxlength="500">
                        </div>
                    </div>

                    <div>
                        En caso de emergencia comunicar a (nombre y teléfono de primer
                        contacto):
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Contacto 1 - Nombre</label>
                            <input type="text" class="form-control" name="contNom1"
                                id="contNom1" value="" placeholder="" maxlength="250" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Contacto 1 - Celular</label>
                            <input type="number" class="form-control" name="contCel1"
                                id="contCel1" value="" placeholder="" maxlength="15" step="1"
                                min="0" max="1000000000" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Contacto 2 - Nombre</label>
                            <input type="text" class="form-control" name="contNom2"
                                id="contNom2" value="" placeholder="" maxlength="250">
                        </div>
                        <div class="col-sm-2">
                            <label>Contacto 2 - Celular</label>
                            <input type="number" class="form-control" name="contCel2"
                                id="contCel2" value="" placeholder="" maxlength="15" step="1"
                                min="0" max="1000000000">
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">II. COMPOSICIÓN FAMILIAR (QUIENES CONFORMAN TU
                    FAMILIA, INCLUIR A PARIENTES QUE VIVAN CON USTED)</div>
                <div class="cuadro">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Nombre y apellidos</label>
                            <input type="text" class="form-control" name="nom_" id="nom_"
                                value="" placeholder="" maxlength="250">
                        </div>
                        <div class="col-sm-3">
                            <label>Parentesco</label>
                            <select class="form-control" name="par_" id="par_">
                                <option value="PAPÁ">PAPÁ</option>
                                <option value="MAMÁ">MAMÁ</option>
                                <option value="HERMANO">HERMANO</option>
                                <option value="HERMANA">HERMANA</option>
                                <option value="TIO">TIO</option>
                                <option value="TIA">TIA</option>
                                <option value="ABUELO">ABUELO</option>
                                <option value="ABUELA">ABUELA</option>
                                <option value="PRIMO">PRIMO</option>
                                <option value="PRIMA">PRIMA</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Grado de Instrucción</label>
                            <select class="form-control" name="gi_" id="gi_">
                                <option value="PRIMARIA">PRIMARIA</option>
                                <option value="SECUNDARIA">SECUNDARIA</option>
                                <option value="SUPERIOR">SUPERIOR</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Edad</label>
                            <input type="number" class="form-control" name="eda_" id="eda_"
                                value="" placeholder="" step="1" min="1" max="100">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Estado Civil</label>
                            <select class="form-control" name="ec_" id="ec_">
                                <option value="SOLTERO">SOLTERO</option>
                                <option value="CASADO">CASADO</option>
                                <option value="CONVIVIENTE">CONVIVIENTE</option>
                                <option value="VIUDO">VIUDO</option>
                                <option value="DIVORSIADO">DIVORSIADO</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Observaciones</label>
                            <select class="form-control" name="obs_" id="obs_">
                                <option value="FALLECIDO">FALLECIDO</option>
                                <option value="VIVE CONMIGO" selected="">VIVE CONMIGO</option>
                                <option value="VIVE EN OTRO LUGAR">VIVE EN OTRO LUGAR</option>
                                <option value="TIENE OTRA FAMILIA">TIENE OTRA FAMILIA</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>&nbsp</label>
                            <button type="button" class="btn btn-primary btn-block"
                                onclick="agregarComposicion();">Agregar</button>
                        </div>
                    </div>

                    <br>
                    <input type="hidden" name="cant_familiares" id="cant_familiares" value="1">
                    <table class="table table-bordered" style="    border: 1px solid #dddddd;">
                        <thead>
                            <tr>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Nombre y apellidos</th>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Parentesco</th>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Grado de Instrucción</th>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Edad</th>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Estado Civil</th>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Observaciones</th>
                                <th
                                    style="text-align: center;background-color: #95b6d2;color: white;">
                                    Acción</th>
                            </tr>
                        </thead>
                        <tbody id="composicion">

                        </tbody>
                    </table>
                    <br>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>¿Quién solventa a tu familia? (jefe del hogar):</label>
                            <select class="form-control" name="qsf" id="qsf">
                                <option value="PAPÁ">PAPÁ</option>
                                <option value="MAMÁ">MAMÁ</option>
                                <option value="HERMANO">HERMANO</option>
                                <option value="HERMANA">HERMANA</option>
                                <option value="TIO">TIO</option>
                                <option value="TIA">TIA</option>
                                <option value="ABUELO">ABUELO</option>
                                <option value="ABUELA">ABUELA</option>
                                <option value="PRIMO">PRIMO</option>
                                <option value="PRIMA">PRIMA</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>¿Quién solventará su carrera universitaria?</label>
                            <select class="form-control" name="qscu" id="qscu">
                                <option value="Mis padres">Mis padres</option>
                                <option value="Padre o madre">Padre o madre</option>
                                <option value="Pariente o tutor">Pariente o tutor</option>
                                <option value="Yo mismo">Yo mismo</option>
                            </select>
                            <m>(Quién cubre sus pasajes, alimentación, matricula y otros
                                referentes a la UNAAT)</m>
                        </div>
                        <div class="col-sm-4">
                            <label>Centro laboral del que financiará su formación
                                universitaria:</label>
                            <input type="text" class="form-control" name="clab" id="clab"
                                value="" placeholder="" maxlength="250" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Ocupación del que financiará su formación
                                universitaria:</label>
                            <input type="text" class="form-control" name="ocup" id="ocup"
                                value="" placeholder="" maxlength="250" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Ingreso Promedio mensual del que financiará su formación
                                universitaria:</label>
                            <input type="number" class="form-control" name="ipmen" id="ipmen"
                                value="0.00" placeholder="0.00" step="0.01" min="0" max="10000"
                                required>
                        </div>
                        <div class="col-sm-4">
                            <label>Cuantas personas dependen directamente del que financiará su
                                formación universitaria</label>
                            <input type="number" class="form-control" name="cpdffu"
                                id="cpdffu" value="" placeholder="" step="1" min="0" max="100"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Si usted trabaja, indique su ocupación:</label>
                            <input type="text" class="form-control" name="tocup" id="tocup"
                                value="NO" placeholder="" maxlength="250">
                        </div>
                        <div class="col-sm-3">
                            <label>Ingreso promedio mensual:</label>
                            <input type="number" class="form-control" name="ipm" id="ipm"
                                value="0.00" placeholder="0.00" step="0.01" min="0" max="10000"
                                required>
                        </div>
                        <div class="col-sm-5">
                            <label>Personas que dependen directamente de Ud.
                                (especificar):</label>
                            <input type="text" class="form-control" name="pddirecud"
                                id="pddirecud" value="0" placeholder="" maxlength="250">
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">III. EDUCACIÓN</div>

                <div class="cuadro">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Condición del centro educativo secundario:</label>
                            <select class="form-control" name="ccedu" id="ccedu">
                                <option value="ESTATAL">ESTATAL</option>
                                <option value="PARROQUIAL">PARROQUIAL</option>
                                <option value="MILITAR">MILITAR</option>
                                <option value="PARTICULAR">PARTICULAR</option>
                                <option value="OTROS">OTROS</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Situación en el colegio</label>
                            <select class="form-control" name="sitCol" id="sitCol">
                                <option value="SIN PAGO">SIN PAGO</option>
                                <option value="PAGO MENSUAL">PAGO MENSUAL</option>
                                <option value="BECADO">BECADO</option>
                                <option value="OTROS">OTROS</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>último monto pagado al colegio (pensión) s/.</label>
                            <input type="number" class="form-control" name="ultmonp"
                                id="ultmonp" value="0.00" placeholder="0.00" step="0.01" min="0"
                                max="10000">
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">IV. VIVIENDA</div>
                <div class="cuadro">
                    <div>La vivienda en que reside es:</div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Tenencia</label>
                            <select class="form-control" name="tenencia" id="tenencia">
                                <option value="PROPIA">PROPIA</option>
                                <option value="ALQUILADA">ALQUILADA</option>
                                <option value="PENSION">PENSION</option>
                                <option value="HIPOTECA">HIPOTECA</option>
                                <option value="OTROS">OTROS</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Material de paredes</label>
                            <select class="form-control" name="matparedes" id="matparedes">
                                <option value="Noble/acabado">Noble/acabado</option>
                                <option value="Rústico/Adobe">Rústico/Adobe</option>
                                <option value="Madera">Madera</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label>Material de piso</label>
                            <select class="form-control" name="matpiso" id="matpiso">
                                <option value="granito o marmol">granito o marmol</option>
                                <option value="ceramica">ceramica</option>
                                <option value="cemento">cemento</option>
                                <option value="tierra">tierra</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>N° de Habitaciones(dormitorios)</label>
                            <select class="form-control" name="numhabdor" id="numhabdor">
                                <option value="UNO">UNO</option>
                                <option value="DOS">DOS</option>
                                <option value="TRES">TRES</option>
                                <option value="CUATRO">CUATRO</option>
                                <option value="05 A MAS">05 A MAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Tipo</label>
                            <select class="form-control" name="tipox" id="tipox">
                                <option value="Casa Independiente">Casa Independiente</option>
                                <option value="Departamento">Departamento</option>
                                <option value="Multifamiliar">Multifamiliar</option>
                                <option value="Quinta">Quinta</option>
                                <option value="Cuarto Solo">Cuarto Solo</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label>La vivienda familiar cuenta con servicios de</label>
                            <div>
                                <input type="checkbox" id="vehicle1" name="vehicle1"
                                    value="Agua">
                                <span> Agua</span>&nbsp
                                <input type="checkbox" id="vehicle2" name="vehicle2"
                                    value="Desagüe">
                                <span> Desagüe</span>&nbsp
                                <input type="checkbox" id="vehicle3" name="vehicle3"
                                    value="Luz">
                                <span> Luz</span>&nbsp
                                <input type="checkbox" id="vehicle4" name="vehicle4"
                                    value="Internet">
                                <span> Internet</span>&nbsp
                                <input type="checkbox" id="vehicle5" name="vehicle5"
                                    value="Cable">
                                <span> Cable</span>&nbsp
                                <input type="checkbox" id="vehicle6" name="vehicle6"
                                    value="Teléfono fijo">
                                <span> Teléfono fijo</span> &nbsp
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">V. SALUD</div>

                <div class="cuadro">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Presenta alguna discapacidad: </label>
                            <select class="form-control" name="paldisc" id="paldisc">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label>Especifique su discapacidad:</label>
                            <input type="text" class="form-control" name="espdisc"
                                id="espdisc" value="" maxlength="500">
                        </div>

                        <div class="col-sm-2">
                            <label>Cuenta con su carnet CONADIS</label>
                            <select class="form-control" name="ccConadis" id="ccConadis">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <label>Adolece de alguna enfermedad:</label>
                            <select class="form-control" name="aslEnf" id="aslEnf">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label>Especifique su enfermedad:</label>
                            <input type="text" class="form-control" name="espenfermedad"
                                id="espenfermedad" value="" maxlength="500">
                        </div>

                        <div class="col-sm-5">
                            <label>En caso de ser (Si) indique que tratamiento sigue:</label>
                            <input type="text" class="form-control" name="tratamientosi"
                                id="tratamientosi" value="" maxlength="500">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <label>Tiene alguna alergia:</label>
                            <select class="form-control" name="alergia" id="alergia">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Especifique su alergia: </label>
                            <input type="text" class="form-control" name="espAlergia"
                                id="espAlergia" value="" maxlength="500">
                        </div>

                        <div class="col-sm-2">
                            <label>Tuvo alguna intervención quirúrgica:</label>
                            <select class="form-control" name="intqui" id="intqui">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Especifique su intervención: </label>
                            <input type="text" class="form-control" name="espinterew"
                                id="espinterew" value="" maxlength="500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">VI. SITUACIÓN SOCIAL Y FAMILIAR</div>

                <div class="cuadro">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>¿Tienes dificultades en el entorno familiar o social?</label>
                            <select class="form-control" name="difEFS" id="difEFS">
                                <option value="SI">SI</option>
                                <option value="NO" selected>NO</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label>Especifique su(s) dificultad(es):</label>
                            <input type="text" class="form-control" name="difesp" id="difesp"
                                value="" maxlength="500">
                        </div>

                        <div class="col-sm-2">
                            <label>Relación con tus padres</label>
                            <select class="form-control" name="rconPadres" id="rconPadres">
                                <option value="Muy buena">Muy buena</option>
                                <option value="Equilibrada">Equilibrada</option>
                                <option value="distanciada">distanciada</option>
                                <option value="conflictiva">conflictiva</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <label>Relación con tus hermanos</label>
                            <select class="form-control" name="relHernos" id="relHernos">
                                <option value="Muy buena">Muy buena</option>
                                <option value="Equilibrada">Equilibrada</option>
                                <option value="distanciada">distanciada</option>
                                <option value="conflictiva">conflictiva</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">VII. SITUACIÓN PARA EL DESARROLLO DE CLASES
                    VIRTUALES</div>

                <div class="cuadro">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>En casa cuenta con:</label>
                            <select class="form-control" name="equip" id="equip">
                                <option value="Laptop">Laptop</option>
                                <option value="Computadora">Computadora</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Smartphone">Smartphone</option>
                                <option value="otros">otros</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label>En casa tiene internet:</label>
                            <select class="form-control" name="tieInternet" id="tieInternet">
                                <option value="Si">Si</option>
                                <option value="Solo a traves del celular">Solo a través del
                                    celular</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label>En el lugar donde vive existe señal de internet:</label>
                            <select class="form-control" name="lcuentainternet"
                                id="lcuentainternet">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>En el lugar donde vive existe señal de celular :</label>
                            <select class="form-control" name="ldonexiSenCel"
                                id="ldonexiSenCel">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label>Qué operadores tienen cobertura en el lugar donde vives
                                :</label>
                            <select class="form-control" name="opesenal" id="opesenal">
                                <option value="Claro">Claro</option>
                                <option value="Bitel">Bitel</option>
                                <option value="Movistar">Movistar</option>
                                <option value="Entel">Entel</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label>Qué redes sociales utilizas más:</label>
                            <select class="form-control" name="redSoc" name="redSoc">
                                <option value="Facebook">Facebook</option>
                                <option value="whatsApp">whatsApp</option>
                                <option value="Telegram">Telegram</option>
                                <option value="otros">otros</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div style="text-align:right;">
            <button type="submit" class="btn btn-primary" name="login-button">Registrar
                Ficha</button>
        </div>
    </form>
    <hr>
    <h5 style="text-align: justify;">DECLARO BAJO JURAMENTO QUE TODA LA INFORMACION CONTENIDA EN
        LA PRESENTE DECLARACIÓN JURADA Y LA DOCUMENTACION ADJUNTA QUE PRESENTO SEGÚN EL CASO, SE
        AJUSTA ESTRICTAMENTE A LA VERDAD. EN CASO DE CAMBIAR TELEFONO, DIRECCION U OTROS, DEBO
        INFORMAR A BIENESTAR UNIVERSITARIO.</h5>
    <h6 style="text-align: justify;">Consentimiento: autorizo previa, libre y expresamente a la
        Universidad para que los datos recopilados en esta ficha sean solamente utilizados para
        fines académicos, ello en cumplimiento a lo dispuesto por la Ley N° 29733 de Protección
        de Datos Personales y el Código de Conducta, ética y Buen Gobierno de la UNAAT.</h6>
    </div>
</div>