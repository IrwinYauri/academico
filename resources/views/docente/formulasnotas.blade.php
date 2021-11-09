@php
 use App\Http\Controllers\SilabusemestreController; 
    function versilabuscriterio($sem,$codcurso,$unidad)
    {
        $silabos=new SilabusemestreController();
        $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
        $tx=count($rptsilabo); 
    //    dd($rptsilabo);
        // if($tx>0)
        $u1="";
        $u2="";
        $u3="";
        $u4="";
        $u5="";
         foreach ($rptsilabo as $versilaboc) {
       
            $u1=$versilaboc->tipoPU1;
              $u2=$versilaboc->tipoPU2;
               $u3=$versilaboc->tipoPU3;
                $u4=$versilaboc->tipoPU4;
                $u5=$versilaboc->tipoPU5;
      
             }
          
        if($unidad==1)
          { return $u1;}
        if($unidad==2)
          { return $u2;}
        if($unidad==3)
          { return $u3;}
        if($unidad==4)
          { return $u4;}
        if($unidad==5)
          { return $u5;}
        
    }

    function versilabusformula($sem,$codcurso,$unidad)
    {
        $silabos=new SilabusemestreController();
        $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
        $tx=count($rptsilabo); 
    //    dd($rptsilabo);
        // if($tx>0)
        $u1="";
        $u2="";
        $u3="";
        $u4="";
        $u5="";
         foreach ($rptsilabo as $versilaboc) {
       
            $u1=$versilaboc->formulaPU1;
              $u2=$versilaboc->formulaPU2;
               $u3=$versilaboc->formulaPU3;
                $u4=$versilaboc->formulaPU4;
                $u5=$versilaboc->formulaPU5;
      
             }
          
        if($unidad==1)
          { return $u1;}
        if($unidad==2)
          { return $u2;}
        if($unidad==3)
          { return $u3;}
        if($unidad==4)
          { return $u4;}
        if($unidad==5)
          { return $u5;}
        
    }
    function versilabusnroeval($sem,$codcurso,$unidad)
    {
        $silabos=new SilabusemestreController();
        $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
        $tx=count($rptsilabo); 
    //    dd($rptsilabo);
        // if($tx>0)
        $u1="";
        $u2="";
        $u3="";
        $u4="";
        $u5="";
         foreach ($rptsilabo as $versilaboc) {
       
            $u1=$versilaboc->nro_evalPU1;
              $u2=$versilaboc->nro_evalPU2;
               $u3=$versilaboc->nro_evalPU3;
                $u4=$versilaboc->nro_evalPU4;
                $u5=$versilaboc->nro_evalPU5;
      
             }
          
        if($unidad==1)
          { return $u1;}
        if($unidad==2)
          { return $u2;}
        if($unidad==3)
          { return $u3;}
        if($unidad==4)
          { return $u4;}
        if($unidad==5)
          { return $u5;}
        
    }
    function formulapf($sem,$codcurso,$tipo)
    {
        $silabos=new SilabusemestreController();
        $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
        $tx=count($rptsilabo); 
    //    dd($rptsilabo);
        // if($tx>0)
       
        $pfti="";
        $pffo="";
       
         foreach ($rptsilabo as $versilaboc) {
       
          $pfti=$versilaboc->tipoPF;
          $pffo=$versilaboc->formulaPF;
             
      
             }
          
        if($tipo==1)
          { return $pfti;}
        if($tipo==2)
          { return $pffo;}
      
        
    }
    function totalnrounidad($sem,$codcurso)
    {
        $silabos=new SilabusemestreController();
        $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
        $tx=count($rptsilabo); 
       // dd($rptsilabo);
       $nrounidad="";
         foreach ($rptsilabo as $versilaboc) {
       $nrounidad=$versilaboc->unidades;
              
             }
         return  $nrounidad;        
    }
@endphp
<style>
    .fondocol{
    background-color: navy;
    color: white;
  }
  .columpro
  {font-weight: bold;
    font-size: 11px;
  }
  .columprof
  {font-weight: bold;
    font-size: 12px;
  }
  .ocultarnota
  {display: none;

  }
</style>