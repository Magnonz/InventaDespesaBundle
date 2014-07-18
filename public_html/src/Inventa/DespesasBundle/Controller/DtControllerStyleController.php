<?php
namespace Inventa\DespesasBundle\Controller;

use Brown298\DataTablesBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DtControllerStyleController
 *
 * @Route("/style/controller/")
 * @package Inventa\DespesasBundle\Controller
 */
class DtControllerStyleController extends AbstractController
{
    /**
     * @var array
     */
    protected $columns = array(
        'user.id'   => 'Id',
        'user.username' => 'Name',
    );

    /**
     * getQueryBuilder
     *
     * @param Request $request
     *
     * @return null
     */
    public function getQueryBuilder(Request $request)
    {
        $em             = $this->get('doctrine.orm.entity_manager');
        $userRepository = $em->getRepository('Inventa\DespesasBundle\Entity\User');
        $qb = $userRepository->createQueryBuilder('user')
            ->andWhere('user.deleted = false');

        return $qb;
    }

    /**
     * dataAction
     *
     * @route("/ajax", name="controller_style_ajax")
     *
     * @param Request $request
     * @param null $dataFormatter
     *
     * @return JsonResponse
     */
    public function dataAction(Request $request, $dataFormatter = null)
    {
        $renderer = $this->get('templating');

        return parent::dataAction($request, function($data) use ($renderer) {
            $count   = 0;
            $results = array();

            foreach ($data as $row) {
                $results[$count][] = $row['id'];
                $results[$count][] = $renderer->render('InventaDespesasBundle:DtControllerStyle:nameFormatter.html.twig', array('name' => $row['username']));
                $count += 1;
            }

            return $results;
        });
    }

    /**
     * indexAction
     *
     * @route("", name="controller_style")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array(
            'columns'       => $this->columns,
        );
    }
}
