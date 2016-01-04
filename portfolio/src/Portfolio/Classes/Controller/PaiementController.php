<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Portfolio\Classes\Controller;

/**
 * Class PaiementController
 * @package Portfolio\Classes\Controller
 */
class PaiementController extends DefaultController
{
	CONST MERCHANT_ID = "014295303911112";

	CONST MERCHANT_COUNTRY = "fr";

	CONST CURRENCY_CODE = "978";

	CONST PATH_CONF_FILE = "etc/sherlocks/pathfile";
	CONST PATH_BIN_REQUEST = "bin/sherlocks/request";
	CONST PATH_BIN_RESPONSE = "bin/sherlocks/response";

	CONST CANCEL_RETURN_URL_VETERINAIRE = "paiement/cancel";
	CONST NORMAL_RETURN_URL_VETERINAIRE = "paiement/reponse";

	CONST AUTOMATIC_RESPONSE_URL = "paiement/autoreponse";

	/**
	 * @param $transaction_id
	 * @param $montant
	 * @return array
	 */
	public function requestPaiement($customer_id, $caddie, $montant, $statut, $customer_email = '') {
		// Affectation des paramètres obligatoires
		$parm  = " merchant_id=".self::MERCHANT_ID;
		$parm .= " merchant_country=".self::MERCHANT_COUNTRY;
		$parm .= " amount=$montant";
		$parm .= " currency_code=".self::CURRENCY_CODE;

		// Initialisation du chemin du fichier pathfile
		$parm .= " pathfile=/home/nicolastyg/www/".self::PATH_CONF_FILE;

		// Affectation des paramètres de la commande
		// $parm .= " transaction_id=$transaction_id";
		$parm .= " customer_id=$customer_id";
		$parm .= " customer_email=$customer_email";
		$parm .= " caddie=$caddie";

		// Initialisatiion des url de retour pour l'API LCL
		$parm .= " cancel_return_url=http://www.nicolas-torre.com/" . self::CANCEL_RETURN_URL_VETERINAIRE;
		$parm .= " normal_return_url=http://www.nicolas-torre.com/" . self::NORMAL_RETURN_URL_VETERINAIRE;

		$parm .= " automatic_response_url=http://www.nicolas-torre.com/" . self::AUTOMATIC_RESPONSE_URL;

		// Initialisation du chemin de l'executable request
		$path_bin = "/home/nicolastyg/www/".self::PATH_BIN_REQUEST;

		// Appel du binaire request
		$parm = escapeshellcmd($parm);
		$result = exec("$path_bin $parm");

		//On separe les differents champs et on les met dans un tableau
		$data = explode("!", "$result");

		// retourne les paramètres code, error et message dans un tableau
		return array(
			'code' => $data[1],
			'error' => $data[2],
			'message' => $data[3]
		);
	}

	/**
	 * @param $transaction_id
	 * @param $montant
	 * @return array
	 */
	public function responsePaiement()
	{
		// Récupération de la variable cryptée DATA
		if (isset($_POST['DATA'])) {
			$message = "message=$_POST[DATA]";

			// Initialisation du chemin du fichier pathfile
			$pathfile = " pathfile=/home/nicolastyg/www/" . self::PATH_CONF_FILE;

			//Initialisation du chemin de l'executable response (à modifier)
			$path_bin = "/home/nicolastyg/www/" . self::PATH_BIN_RESPONSE;

			// Appel du binaire response
			$message = escapeshellcmd($message);
			$result = exec("$path_bin $pathfile $message");

			//On separe les differents champs et on les met dans un tableau
			$data = explode("!", $result);

			return array(
				'code' => $data[1],
				'error' => $data[2],
				'merchant_id' => $data[3],
				'merchant_country' => $data[4],
				'amount' => $data[5],
				'transaction_id' => $data[6],
				'payment_means' => $data[7],
				'transmission_date' => $data[8],
				'payment_time' => $data[9],
				'payment_date' => $data[10],
				'response_code' => $data[11],
				'payment_certificate' => $data[12],
				'authorisation_id' => $data[13],
				'currency_code' => $data[14],
				'card_number' => $data[15],
				'cvv_flag' => $data[16],
				'cvv_response_code' => $data[17],
				'bank_response_code' => $data[18],
				'complementary_code' => $data[19],
				'complementary_info' => $data[20],
				'return_context' => $data[21],
				'caddie' => $data[22],
				'receipt_complement' => $data[23],
				'merchant_language' => $data[24],
				'language' => $data[25],
				'customer_id' => $data[26],
				'order_id' => $data[27],
				'customer_email' => $data[28],
				'customer_ip_address' => $data[29],
				'capture_day' => $data[30],
				'capture_mode' => $data[31],
				'data' => $data[32],
				'order_validity' => $data[33],
				'transaction_condition' => $data[34],
				'statement_reference' => $data[35],
				'card_validity' => $data[36],
				'score_value' => $data[37],
				'score_color' => $data[38],
				'score_info' => $data[39],
				'score_threshold' => $data[40],
				'score_profile' => $data[41],
				'threed_ls_code' => $data[43],
				'threed_relegation_code' => $data[44]
			);
		} else {
			return false;
		}
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function indexAction(Request $request, Application $app) {

		$montanttotal = 100;

		// création du caddie
		$caddie = array(
			'5',
			'10',
			'15'
		);
		$caddie = implode(",",$caddie);

		$statut = 'dev';

		$result = $this->requestPaiement('id-007', $caddie, $montanttotal, $statut);

		//  analyse du code retour
		if (($result['code'] == "") && ($result['error'] == "")) {

			return $app['twig']->render('Pages/Paiement/Index.html.twig', array(
				'error' => 'Erreur 1!'
			));
		} elseif ($result['code'] != 0) {

			return $app['twig']->render('Pages/Paiement/Index.html.twig', array(
				'error' => $result['error']
			));
		} // OK, affiche le formulaire HTML
		else {

			return $app['twig']->render('Pages/Paiement/Index.html.twig', array(
				'error' => $result['error'],
				'message' => $result['message']
			));
		}
	}

	/**
	 * cancel
	 *
	 * @param Request $request
	 * @param Application $app
	 */
	public function cancelAction(Request $request, Application $app) {

		return $app['twig']->render('Pages/Paiement/Cancel.html.twig', array(
			'error' => 'Transaction annulée',
		));
	}

	/**
	 * reponse
	 *
	 * @param Request $request
	 * @param Application $app
	 */
	public function reponseAction(Request $request, Application $app) {

		$result = $this->responsePaiement();

		//  analyse du code retour
		if (($result['code'] == "") && ($result['error'] == "")) {

			return $app['twig']->render('Pages/Paiement/Reponse.html.twig', array(
				'error' => 'Erreur 1!'
			));
		} elseif ($result['code'] != 0) {

			return $app['twig']->render('Pages/Paiement/Reponse.html.twig', array(
				'error' => $result['error']
			));
		} // OK, affiche le formulaire HTML
		else {
			if ("00" == $result['bank_response_code']) {

				return $app['twig']->render('Pages/Paiement/Reponse.html.twig', array(
					'error' => $result['error'],
					'message' => 'Paiement effectuée'
				));
			}
		}
	}

	/**
	 * autoreponse
	 *
	 * @param Request $request
	 * @param Application $app
	 */
	public function autoreponseAction(Request $request, Application $app) {

		$result = $this->responsePaiement();

		//  analyse du code retour
		if (($result['code'] == "") && ($result['error'] == "")) {

			$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
			$txt = "Erreur 1: ".date('l jS \of F Y h:i:s A')."\n";
			fwrite($myfile, $txt);
			fclose($myfile);
		} elseif ($result['code'] != 0) {

			$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
			$txt = "Erreur 2: ". $result['error']. " - " .date('l jS \of F Y h:i:s A')."\n";
			fwrite($myfile, $txt);
			fclose($myfile);
		} // OK, affiche le formulaire HTML
		else {
			if("00" == $result['bank_response_code']) {
				$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
				$txt = "Paiement effectuée: ".date('l jS \of F Y h:i:s A')."\n";
				fwrite($myfile, $txt);
				fclose($myfile);
			}
		}
	}

}