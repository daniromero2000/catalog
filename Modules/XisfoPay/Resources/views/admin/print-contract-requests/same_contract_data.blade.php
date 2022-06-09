<table class="table-striped info_basic" style="width: 100%;">
    <tbody>
        @foreach($contract_request->customer->customerReferences as $custref)
        <tr>
            <td width="50%">
                <strong>Nombre del {{ $custref->relationship->relationship }}:</strong><br>
                {{ $custref->name }} {{ $custref->last_name }}
            </td>
            <td width="50%">
                <strong>Teléfono / Celular:</strong><br>
                {{ $custref->phone }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<table class="table-striped title_center_" style="width: 100%;">
    <h4 style="text-align:center;"><b>CUENTAS BANCARIAS CLIENTE</b></h4>
</table>
<table class="table-striped info_basic" style="width: 100%;">
    <tbody>
        <tr>
            <td width="100%">
                <strong>Número de Cuenta:</strong>
                <span>{{ $contract_request->customer->customerBankAccounts[0]->account_type }} /
                    {{ $contract_request->customer->customerBankAccounts[0]->account_number }} </span>
                <span align="right">
                    <strong>Banco:</strong>
                </span>{{ $contract_request->customer->customerBankAccounts[0]->bank->name }}
            </td>
        </tr>
    </tbody>
</table>
<table class="table-striped title_center_" style="width: 100%;">
    <h4 style="text-align:center;"><b><b>IMPORTANTE:</b> <small>El envío del logo de su empresa o estudio es primordial para el proceso de
        vinculación</small></b></h4>
</table>
<div><br>
    <h5>AUTORIZACI&Oacute;N PARA EL TRATAMIENTO DE DATOS PERSONALES</h5>
    SYC GROUP SAS y/o sus empresas asociadas ser&aacute; el responsable del tratamiento y, en tal virtud,
    podr&aacute; recolectar, almacenar, usar.<br>
    Advertencia: Cada finalidad que usted incluya en este formato debe contar con un mecanismo que
    le permita al Titular seleccionar por separado si acepta o no que se efect&uacute;e ese tratamiento particular.<br>
    Manifiesto que me informaron que, en caso de recolecci&oacute;n de mi informaci&oacute;n sensible, tengo derecho
    a contestar o no las preguntas que me formulen y a entregar o no los datos solicitados.<br>
    Entiendo que son datos sensibles aquellos que afectan la intimidad del Titular o cuyo uso indebido
    puede generar discriminaci&oacute;n.<br>
    Manifiesto que me informaron que los datos sensibles que se recolectar&aacute;n ser&aacute;n utilizados para
    finalidades comerciales o ligadas a la operaci&oacute;n.<br>
    DERECHOS DEL TITULAR<br>
    Sus derechos como titular del dato son los previstos en la Constituci&oacute;n y en la Ley 1581 de 2012,
    especialmente los siguientes:<br>
    A) Acceder en forma gratuita a los datos proporcionados que hayan sido objeto de tratamiento.<br>
    B) Solicitar la actualizaci&oacute;n y rectificaci&oacute;n de su informaci&oacute;n frente a datos parciales,
    inexactos,
    incompletos, fraccionados, que induzcan a error, o a aquellos cuyo tratamiento est&eacute; prohibido o no
    haya sido autorizado.<br>
    C) Solicitar prueba de la autorizaci&oacute;n otorgada.<br>
    D) Presentar ante la superintendencia de Industria y Comercio (SIC) quejas por infracciones a lo
    dispuesto en la normatividad vigente.<br>
    E) Revocar la autorizaci&oacute;n y/o solicitar la supresi&oacute;n del dato, a menos que exista un deber legal o
    contractual que haga imperativo conservar la informaci&oacute;n.<br>
    F) Abstenerse de responder las preguntas sobre datos sensibles o sobre datos de las ni&ntilde;as y ni&ntilde;os y
    adolescentes. Estos derechos los podr&eacute; ejercer a trav&eacute;s de los canales o medios dispuestos por SYC
    GROUP SAS,
    para la atenci&oacute;n al p&uacute;blico, la l&iacute;nea de atenci&oacute;n nacional 322 614 6040, el correo
    electr&oacute;nico info@xisfo.com
    y las oficinas de atenci&oacute;n al cliente a nivel nacional, cuya informaci&oacute;n puedo consultar en
    www.xisfo.com,
    disponibles de lunes a viernes de 8:00 a.m. a 5:00 p.m., para la atenci&oacute;n de requerimientos relacionados con
    el tratamiento de mis datos personales y el ejercicio de los derechos mencionados en esta autorizaci&oacute;n.<br>
    Por todo lo anterior, he otorgado mi consentimiento a SYC GROUP SAS para que trate mi informaci&oacute;n personal de
    acuerdo con la Pol&iacute;tica de Tratamiento de Datos Personales dispuesta por la sociedad y, que me dio a conocer
    antes de recolectar mis datos personales.<br>
    Manifiesto que la presente autorizaci&oacute;n me fue solicitada y puesta de presente antes de entregar mis datos y
    que la suscribo de forma libre y voluntaria una vez le&iacute;da en su totalidad.<br>
    Nombre: {{ $contract_request->customer->name }} {{ $contract_request->customer->last_name }} (del
    titular)<br>
    Firma: __________________________ (del titular)<br>
    Identificaci&oacute;n: {{$contract_request->customer->customerIdentities[0]->identity_number }} (del
    titular)<br>
    Fecha: {{ $fecha }} (Fecha en que se puso de presente al titular la autorizaci&oacute;n y entreg&oacute; sus
    datos)<br><br>

    <table style="width:100%;padding:0;margin:0;">
        <tr>
            <td class="bordersolid" style="width: 90%;">
                <b>FINALIDAD</b>
            </td>
            <td class="bordersolid" style="width: 10%;">
                <div style="border-bottom:solid 1px #000;width:100%; font-size:7 !important">
                    <b>AUTORIZA</b>
                </div>
                <div style="border-right:solid 1px #000;width:50%;">
                    <b>SI</b>
                </div>
                <div style="width:50%;float:right;position:absolute;top:13px;">
                    <b>NO</b>
                </div>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Transferir datos personales fuera del pa&iacute;s a la compa&ntilde;&iacute;a matriz de SYC GROUP SAS
                para
                cumplir con las regulaciones anti lavado de activos que le aplican.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Transferir los datos personales fuera del pa&iacute;s a terceros con los cuales SYC GROUP SAS
                haya suscrito un contrato de procesamiento de datos y sea necesario entreg&aacute;rsela para el
                cumplimiento del
                objeto contractual.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Prestar los servicios ofrecidos por SYC GROUP SAS y, aceptados en el contrato suscrito.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Suministrar la informaci&oacute;n a terceros con los cuales SYC GROUP SAS tenga relaci&oacute;n
                contractual y que sea necesario entreg&aacute;rsela para el cumplimiento del objeto contratado.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Efectuar las gestiones pertinentes para el desarrollo del objeto social de la compa&ntilde;&iacute;a en
                lo que tiene que ver con el cumplimiento del objeto del contrato celebrado con
                el Titular de la informaci&oacute;n.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Realizar invitaciones a eventos y ofrecer nuevos productos y servicios.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Gestionar tr&aacute;mites (solicitudes, quejas, reclamos).
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Efectuar encuestas de satisfacci&oacute;n respecto de los bienes y servicios ofrecidos por SYC GROUP
                SAS.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Suministrar informaci&oacute;n de contacto a la fuerza comercial y/o red de distribuci&oacute;n,
                telemercadeo, investigaci&oacute;n de mercados y cualquier tercero con el cual SYC GROUP SAS tenga un
                v&iacute;nculo contractual para el desarrollo de actividades de ese tipo (investigaci&oacute;n de
                mercados y telemercadeo, etc.) para la ejecuci&oacute;n de las mismas.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Contactar al Titular a trav&eacute;s de medios telef&oacute;nicos para realizar encuestas, estudios y/o
                confirmaci&oacute;n de datos personales necesarios para la ejecuci&oacute;n de una relaci&oacute;n
                contractual.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Contactar al Titular a trav&eacute;s de medios electr&oacute;nicos – SMS o chat para el env&iacute;o de
                noticias relacionadas con campa&ntilde;as de fidelizaci&oacute;n o mejora de servicio.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
        <tr>
            <td class="bordersolid" style="width: 90%;">
                Contactar al Titular a trav&eacute;s de correo electr&oacute;nico para el env&iacute;o de extractos,
                estados de cuenta o facturas en relaci&oacute;n con las obligaciones derivadas del contrato celebrado
                entre las partes.
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
            <td class="bordersolid" style="width: 5%;">
            </td>
        </tr>
    </table>
   <br><br>
    <h5><b>POL&Iacute;TICA DE TRATAMIENTO DE DATOS PERSONALES</b></h5><br>
    OBJETIVO: Establecer los criterios para la recolecci&oacute;n, almacenamiento, uso, circulaci&oacute;n y
    supresi&oacute;n de los datos personales tratados por SYC GROUP SAS.<br>
    ALCANCE: Esta pol&iacute;tica aplica para toda la informaci&oacute;n personal registrada en las bases de datos
    de SYC GROUP SAS, quien act&uacute;a en calidad de responsable del tratamiento de los datos personales.<br>
    OBLIGACIONES: Esta pol&iacute;tica es de obligatorio y estricto cumplimiento para SYC GROUP SAS.<br>
    RESPONSABLE DEL TRATAMIENTO: SYC GROUP SAS, sociedad comercial legalmente constituida, identificada con el NIT
    900959301-3, con domicilio principal en la CR 7 # 20 32 de la ciudad de Pereira, Risaralda, Rep&uacute;blica
    de Colombia. P&aacute;gina www.xisfo.com Tel&eacute;fono 036 324 7858 en la ciudad de Pereira, Risaralda.<br>
    TRATAMIENTO Y FINALIDAD: El tratamiento que realizar&aacute; SYC GROUP SAS con la informaci&oacute;n personal
    ser&aacute; el siguiente:<br>
    La recolecci&oacute;n, almacenamiento, uso, circulaci&oacute;n.<br>
    TRATAMIENTO DE DATOS SENSIBLES:<br>
    Los datos sensibles recolectados ser&aacute;n tratados con las siguientes finalidades:<br>
    DERECHOS DE LOS TITULARES: Como titular de sus datos personales Usted tiene derecho a:<br>
    (i) Acceder de forma gratuita a los datos proporcionados que hayan sido objeto de tratamiento.<br>
    (ii) Conocer, actualizar y rectificar su informaci&oacute;n frente a datos parciales, inexactos, incompletos,
    fraccionados, que induzcan a error, o aquellos cuyo tratamiento est&eacute; prohibido o no haya sido autorizado.<br>
    (iii) Solicitar prueba de la autorizaci&oacute;n otorgada.<br>
    (iv) Presentar ante la superintendencia de Industria y Comercio (SIC) quejas por infracciones a lo dispuesto
    en la normatividad vigente.<br>
    (v) Revocar la autorizaci&oacute;n y/o solicitar la supresi&oacute;n del dato, siempre que no exista un deber
    legal o contractual que impida eliminarlos.<br>
    (vi) Abstenerse de responder las preguntas sobre datos sensibles.Tendr&aacute; car&aacute;cter facultativo
    las respuestas que versen sobre datos sensibles o sobre datos de las ni&ntilde;as y ni&ntilde;os y adolescentes.<br>
    ATENCI&Oacute;N DE PETICIONES, CONSULTAS Y RECLAMOS<br>
    El &aacute;rea de Mercadeo es la dependencia que tiene a cargo dar tr&aacute;mite a las solicitudes de los
    titulares para hacer efectivos sus derechos por medio del correo info@xisfo.com<br><br>
    <h5><b>PROCEDIMIENTO PARA EL EJERCICIO DEL DERECHO DE HABEAS DATA</b></h5>
    <br>En cumplimiento de las normas sobre protecci&oacute;n de datos personales, SYC GROUP SAS presenta el
    procedimiento y requisitos m&iacute;nimos para el ejercicio de sus derechos:<br>
    Para la radicaci&oacute;n y atenci&oacute;n de su solicitud le solicitamos suministrar la siguiente
    informaci&oacute;n:<br>
    Nombre completo y apellidos Datos de contacto (Direcci&oacute;n f&iacute;sica y/o electr&oacute;nica y
    tel&eacute;fonos de contacto), Medios para recibir respuesta a su solicitud, Motivo(s)/hecho(s) que dan lugar
    al reclamo con una breve descripci&oacute;n del derecho que desea ejercer (conocer, actualizar, rectificar,
    solicitar prueba de la autorizaci&oacute;n otorgada, revocarla, suprimir, acceder a la informaci&oacute;n)
    Firma (si aplica) y n&uacute;mero de identificaci&oacute;n.<br>
    El t&eacute;rmino m&aacute;ximo previsto por la ley para resolver su reclamaci&oacute;n es de quince (15)
    d&iacute;as h&aacute;biles, contado a partir del d&iacute;a siguiente a la fecha de su recibo. Cuando no
    fuere posible atender el reclamo dentro de dicho t&eacute;rmino, SYC GROUP SAS informar&aacute; al interesado
    los motivos de la demora y la fecha en que se atender&aacute; su reclamo, la cual en ning&uacute;n caso
    podr&aacute; superar los ocho (8) d&iacute;as h&aacute;biles siguientes al vencimiento del primer t&eacute;rmino.
    <br>Una vez cumplidos los t&eacute;rminos se&ntilde;alados por la Ley 1581 de 2012 y las dem&aacute;s normas que
    la reglamenten o complementen, el Titular al que se deniegue, total o parcialmente, el ejercicio de los
    derechos de acceso, actualizaci&oacute;n, rectificaci&oacute;n, supresi&oacute;n y revocaci&oacute;n,
    podr&aacute; poner su caso en conocimiento de la Superintendencia de Industria y Comercio –Delegatura para
    la Protecci&oacute;n de Datos Personales.
    <br>VIGENCIA: La presente Pol&iacute;tica para el Tratamiento de Datos Personales rige a partir del momento de
    firma.
    <br>Las bases de datos en las que se registrar&aacute;n los datos personales tendr&aacute;n una vigencia igual al
    tiempo en que se mantenga y utilice la informaci&oacute;n para las finalidades descritas en esta pol&iacute;tica.
    <br>Los datos personales proporcionados se conservar&aacute;n mientras no se solicite su supresi&oacute;n por el
    interesado y siempre que no exista un deber legal de conservarlos.
    <br>AVISO DE PRIVACIDAD
    <br>El presente Aviso de Privacidad (en adelante el “Aviso”) establece los t&eacute;rminos y condiciones en
    virtud de los cuales SYC GROUP SAS, identificado con NIT 900959301-3 y con domicilio en la CR 7 # 20 32 de
    Pereira, Risaralda, realizar&aacute; el tratamiento de sus datos personales.
    <br>1. TRATAMIENTO Y FINALIDAD:
    <br>El tratamiento que realizar&aacute; SYC GROUP SAS con la informaci&oacute;n personal ser&aacute; el siguiente:
    <br>La recolecci&oacute;n, almacenamiento, uso, circulaci&oacute;n.
    <br>2.MECANISMOS PARA CONOCER LA POL&Iacute;TICA DE TRATAMIENTO
    <br>El Titular puede acceder a nuestra Pol&iacute;tica de Tratamiento de informaci&oacute;n, la cual se encuentra
    publicada en medio f&iacute;sico: la cartelera ubicada en la recepci&oacute;n de la empresa ubicada en la
    CR 7 # 20 32 Edificio Las Palmas o en nuestra p&aacute;gina web https://www.xisfo.com.

<br><br>
    <h5><b>GLOSARIO</b></h5>
    <b>• Dato personal:</b> Se trata de cualquier informaci&oacute;n vinculada o que pueda asociarse a una persona
    determinada, como su
    nombre o n&uacute;mero de identificaci&oacute;n, o que puedan hacerla determinable, como sus rasgos f&iacute;sicos.
    <br><b>• Dato p&uacute;blico:</b> Es uno de los tipos de datos personales existentes. Son considerados datos
    p&uacute;blicos,
    entre otros, los datos relativos al estado civil de las personas, a su profesi&oacute;n u oficio y a su
    calidad de comerciante o de servidor p&uacute;blico. Por su naturaleza, los datos p&uacute;blicos pueden
    estar contenidos, entre otros, en registros p&uacute;blicos, documentos p&uacute;blicos, gacetas y boletines
    oficiales y sentencias judiciales debidamente ejecutoriadas que no est&eacute;n sometidas a reserva.
    <br><b>• Dato semiprivado:</b> Son los datos que no tienen naturaleza &iacute;ntima, reservada, ni p&uacute;blica y
    cuyo
    conocimiento o divulgaci&oacute;n puede interesar no solo al titular sino a cierto sector o a la sociedad en
    general. Los datos financieros y crediticios de la actividad comercial o de servicios, son algunos ejemplos.
    <br><b>• Dato privado:</b> Es el dato que por su naturaleza &iacute;ntima o reservada solo es relevante para el
    titular.
    Los gustos o preferencias de las personas, por ejemplo, corresponden a un dato privado.
    <br><b>• Datos sensibles:</b> Son aquellos que afectan la intimidad del titular o pueden dar lugar a que lo
    discriminen,
    es decir, aquellos que revelan su origen racial o &eacute;tnico, su orientaci&oacute;n pol&iacute;tica, las
    convicciones religiosas o filos&oacute;ficas, la pertenencia a sindicatos, organizaciones sociales, de
    derechos humanos, as&iacute; como los datos relativos a la salud, a la vida sexual, y los datos biom&eacute;tricos,
    entre otros.
    <br>
    <table style="width:100%;padding:0px;margin:0;">
        <tr>
            <td style="width: 40%;padding-top:100px;">
                <span style="border-top:solid 1px #000;">Firma de Solicitante<br>
                    # de Documento:</span>
            </td>
            <td style="width: 20%;margin:auto;">
                <div style="border:solid 1px #000;width:80%;height:120px;border-radius:5px;">
                </div>
                <span style="text-align: center;padding-top:130px;padding-left:30px;">Huella</span>
            </td>
            @if ($contract_request->employee)
            <td style="width: 40%;padding-top:0px;">
                <img src="{{ 'storage/' . $contract_request->employee->signature }}" class="img-fluid lazy" width="100"
                    height="85"><br>
                <span style="border-top:solid 1px #000;">Firma de Comercial<br>
                    # de Documento:</span> {{ $contract_request->employee->employeeIdentities[0]->identity_number }}
            </td>
            @else
            <td style="width: 40%;padding-top:100px;">
                <span style="border-top:solid 1px #000;">Firma de Comercial<br>
                    # de Documento:</span>
            </td>
            @endif

        </tr>
    </table>
</div>
