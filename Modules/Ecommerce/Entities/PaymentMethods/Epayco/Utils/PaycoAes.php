<?php

namespace Modules\Ecommerce\Entities\PaymentMethods\Epayco\Utils;

use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Utils\McryptEncrypt;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Utils\OpensslEncrypt;

/**
 * Epayco library encrypt based in AES
 */



class PaycoAes extends OpensslEncrypt
{
}


// /**
//  * Epayco library encrypt based in AES
//  */
// if (function_exists('mcrypt_get_iv_size')) {

//     class PaycoAes extends McryptEncrypt
//     {
//     }
// } else {

//     class PaycoAes extends OpensslEncrypt
//     {
//     }
// }
