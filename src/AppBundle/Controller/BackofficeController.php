<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Company;
use AppBundle\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Data\Util\ArrayAccessibleResourceBundle;

class BackofficeController extends Controller
{
    public function backofficeAction()
    {
        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');

        $companies = $companyRepository->findAll();

        return $this->render('backoffice/backoffice.html.twig', ['companies' => $companies]);
    }

    public function saveAction(Request $request)
    {
        $companyName = $request->get('company_name');
        $companyDescription = $request->request->get('company_description');

        $company = new Company();
        $company->setName($companyName);
        $company->setDescription($companyDescription);

        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this->getDoctrine()->getRepository('AppBundle:Company');
        $companyRepository->persist($company);

        $companies = $companyRepository->findAll();

        return $this->render('backoffice/backoffice.html.twig', ['companies' => $companies]);
    }

}