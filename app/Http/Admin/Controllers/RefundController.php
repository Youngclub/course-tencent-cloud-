<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Services\Refund as RefundService;

/**
 * @RoutePrefix("/admin/refund")
 */
class RefundController extends Controller
{

    /**
     * @Get("/search", name="admin.refund.search")
     */
    public function searchAction()
    {

    }

    /**
     * @Get("/list", name="admin.refund.list")
     */
    public function listAction()
    {
        $refundService = new RefundService();

        $pager = $refundService->getRefunds();

        $this->view->setVar('pager', $pager);
    }

    /**
     * @Get("/{id}/show", name="admin.refund.show")
     */
    public function showAction($id)
    {
        $refundService = new RefundService();

        $refund = $refundService->getRefund($id);
        $order = $refundService->getOrder($refund->order_sn);
        $trade = $refundService->getTrade($refund->trade_sn);
        $user = $refundService->getUser($trade->user_id);

        $this->view->setVar('refund', $refund);
        $this->view->setVar('order', $order);
        $this->view->setVar('trade', $trade);
        $this->view->setVar('user', $user);
    }

    /**
     * @Post("/{id}/review", name="admin.refund.review")
     */
    public function reviewAction($id)
    {
        $refundService = new RefundService;

        $refundService->reviewRefund($id);

        $location = $this->request->getHTTPReferer();

        $content = [
            'location' => $location,
            'msg' => '审核退款成功',
        ];

        return $this->ajaxSuccess($content);
    }

}
