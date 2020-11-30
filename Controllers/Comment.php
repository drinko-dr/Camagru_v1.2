<?php

class Comment extends Controller
{
    public function delete_comment()
    {
        $this->loadModel('CommentModel');
        if (isset($_POST['comment_id']) && is_numeric($_POST['comment_id']) && $_POST['comment_id'] > 0) {
			$comment = $this->CommentModel->get_comment('comment_id', $_POST['comment_id']);
			// Delete comment if owner of comment or admin
			if (!empty($comment) && ($_SESSION['role'] == "admin" || $comment['user_id'] == $_SESSION['id'])) {
				$this->CommentModel->delete_comment('comment_id', $comment['comment_id']);
				if ($_SESSION['role'] == "admin") {
					header("Location: /index.php/admin/comments");
				} else {
					header("Location: /index.php/post?post_id=" . $comment['post_id']);
				}
			}
			else {
				header("Location: /404.php");
			}
        }
        else {
			header("location:javascript://history.go(-1)");
		}
    }
}