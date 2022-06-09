<?php

namespace Modules\TusDatos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TusDatos\Entities\TusDatosConsultations\UseCases\Interfaces\TusDatosConsultationUseCaseInterface;

class TusDatosController extends Controller
{
    private $password, $user, $tusDatosConsultationServiceInterface;

    public function __construct(
        TusDatosConsultationUseCaseInterface $tusDatosConsultationUseCaseInterface
    ) {
        $this->tusDatosConsultationServiceInterface = $tusDatosConsultationUseCaseInterface;
        $this->user     = env('TUS_DATOS_USER');
        $this->password = env('TUS_DATOS_PASSWORD');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $reportId = '60b7e2799eecb38ac6aabf87';
        dd($this->getJsonCustomerConsultationReport($reportId));

        $consult = [
            "email" => "desarrollador2.syc@gmail.com",
            "id" => 1088353252,
            "jobid" => "1d24f914-3d1f-419d-932c-594132948d6e",
            "nombre" => "JULIAN ESTEBAN GIRALDO MONCADA ",
            "typedoc" => "CC",
            "validado" => true
        ];

        $arrayData = [
            "email" => "desarrollador2.syc@gmail.com",
            "identiy_number" => $consult['id'],
            "jobid" => "1d24f914-3d1f-419d-932c-594132948d6e",
            "name" => $consult['nombre'],
            "typedoc" => "CC",
            "validado" => true
        ];


        //dd($this->tusDatosConsultationServiceInterface->storeTusDatosConsultation($arrayData));

        return view('tusdatos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tusdatos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tusdatos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('tusdatos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    private function getJsonCustomerConsultationReport($reportId)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_USERPWD, "$this->user:$this->password");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, env('TUS_DATOS_PRODUCTION_URL', false) . '/api/report_json/' . $reportId);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

    private function launchCustomerConsultation()
    {
        $myObj =  ["doc" => 1088353252, "typedoc" => "CC", "fechaE" => "06/02/2017"];
        $myJSON = json_encode($myObj);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myJSON);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_USERPWD, "$this->user:$this->password");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, env('TUS_DATOS_PRODUCTION_URL', false) . '/api/launch/');
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }
}
