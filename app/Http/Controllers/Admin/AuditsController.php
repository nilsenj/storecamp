<?php

namespace App\Http\Controllers\Admin;

use App\Core\Models\AttributeGroup;
use App\Core\Models\AttributeGroupDescription;
use App\Core\Models\Campaign;
use App\Core\Models\Category;
use App\Core\Models\Folder;
use App\Core\Models\Mail;
use App\Core\Models\Media;
use App\Core\Models\Permission;
use App\Core\Models\Product;
use App\Core\Models\ProductReview;
use App\Core\Models\Role;
use App\Core\Models\Subscribers;
use App\Core\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditsController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "admin.audits.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/audits";

    /**
     * @param $model
     * @return Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($model=null) {
        switch ($model) {
            case "products":
                if (Product::isAuditEnabled()) {
                    $model = new Product();
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            default:
                if (Product::isAuditEnabled()) {
                    $model = new Product();
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
        }
        dd($audits);
        return $this->view('index', compact('model', 'audits'));
    }

    public function show(Request $request, $model, $id) {
        switch ($model) {
            case "product":
                if (Product::isAuditEnabled()) {
                    $model = Product::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "attributeGroup":
                if (AttributeGroup::isAuditEnabled()) {
                    $model = AttributeGroup::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "attributeGroupDescription":
                if (AttributeGroupDescription::isAuditEnabled()) {
                    $model = AttributeGroupDescription::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "campaign":
                if (Campaign::isAuditEnabled()) {
                    $model = Campaign::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "category":
                if (Category::isAuditEnabled()) {
                    $model = Category::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "folder":
                if (Folder::isAuditEnabled()) {
                    $model = Folder::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "mail":
                if (Mail::isAuditEnabled()) {
                    $model = Mail::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "media":
                if (Media::isAuditEnabled()) {
                    $model = Media::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "permission":
                if (Permission::isAuditEnabled()) {
                    $model = Permission::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "productReview":
                if (ProductReview::isAuditEnabled()) {
                    $model = ProductReview::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "role":
                if (Role::isAuditEnabled()) {
                    $model = Role::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "subscribers":
                if (Subscribers::isAuditEnabled()) {
                    $model = Subscribers::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            case "user":
                if (User::isAuditEnabled()) {
                    $model = User::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
                break;
            default:
                if (Product::isAuditEnabled()) {
                    $model = Product::find($id);
                    $audits = $model->audits;
                } else {
                    return $this->redirectNotFound();
                }
        }
        return $this->view('show', compact('model', 'audits'));
    }
}
