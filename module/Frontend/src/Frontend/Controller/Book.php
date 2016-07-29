<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Frontend\Controller;

use Sale\Model\BookInterface as BookModelInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Zend\Session\Container as SessionContainer;
use Zend\View\Model\ViewModel;

/**
 * Class Book
 * @package Frontend\Controller
 */
class Book extends AbstractActionController
{
    /**  Book buy success message */
    const BOOK_BUY_SUCCESS_MESSAGE = "Book ordered successfully.";

    /**
     * @var BookModelInterface
     */
    protected $bookModel;

    /**
     * Sale constructor.
     * @param BookModelInterface $bookModel
     */
    public function __construct(BookModelInterface $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    /**
     * @return ViewModel
     */
    public function listAction()
    {
        $bookModel    = $this->bookModel;
        $bookEntities = $bookModel->findAll();

        $session = new SessionContainer('bookView');

        return new ViewModel([
            'bookEntities'    => $bookEntities,
            'bookViewSession' => $session
        ]);
    }

    /**
     * @return ViewModel
     */
    public function detailAction()
    {
        $bookModel = $this->bookModel;
        $request   = $this->getRequest();
        $params    = $this->params();
        $bookId    = $params->fromRoute('book-id');

        $bookEntity = $bookModel->findById($bookId);
        if (!$bookEntity) {
            $this->flashMessenger()->addMessage(
                sprintf(
                    'Failed to find book by id: %d',
                    $bookId),
                FlashMessenger::NAMESPACE_ERROR
            );

            $response = $this->redirect()->toRoute('bookList');
            return $response;
        }

        $form     = $bookModel->getOrderForm();
        $request  = $this->getRequest();
        $session  = new SessionContainer('bookView');

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {
                if ($session->offsetExists($bookId)) {
                    $session->offsetUnset($bookId);  //remove the purchased book from visited
                }
                $bookModel->orderNow($form->getObject(), $bookEntity);

                $this->flashMessenger()->addMessage(
                    self::BOOK_BUY_SUCCESS_MESSAGE,
                    FlashMessenger::NAMESPACE_SUCCESS
                );

                return $this->redirect()->toRoute(
                    'bookDetail',
                    [
                        'book-id' => $bookId
                    ]
                );
            }
        } else {

            if (!$session->offsetExists($bookId)) {
                $session->offsetSet($bookId, $bookEntity->getTitle());
            }
            //  $session->getManager()->destroy();
        }

        return new ViewModel([
            'bookEntity' => $bookEntity,
            'buyForm' => $form
        ]);
    }

}