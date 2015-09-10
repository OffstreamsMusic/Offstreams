<?php

	class aboutHomeView {
		
		
		
		public function buildFAQ($faq = array()) {
			global $model;
			
			$li = null;
			for($i = 0; $i < count($model->faq["faq_id"]); $i++) {
				$li .= "
						<div class='faqQuestionWrapper'>
							<div class='faqQuestion'>
								<span>" . $model->faq["faq_question"][$i] . "</span>
							</div>
							<div class='faqAnswer' id='faq" . $model->faq["faq_id"][$i] . "'>
								<span>" . $model->faq["faq_answer"][$i] . "
							</div>
						</div>
						";
			}
			
			if (!empty($li)) {
				
				return $li;
				
			} else {
				
				return null;
				
			}
		}
		
	}

?>