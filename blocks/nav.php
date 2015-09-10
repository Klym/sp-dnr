<nav>
    <div class="<?= ($page == "index") ? "active" : "";  ?>">
        <a href="index.php" class="navButton">
            <div>Главная<div class="delimiter"></div></div>
        </a>
        <div class="hidden"></div>
    </div>
    
    <div class="<?= ($page == "news") ? "active" : "";  ?>">
        <a href="news.php" class="navButton">
            <div >
                Новости
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden">
        	<?php
				require_once("packages/info/mapper/CategoryMapper.php");
				require_once("packages/info/domain/Category.php");	
				$category = new info\mapper\CategoryMapper($pdo);
				try {
					$categories = $category->findAll();
				} catch(Exception $e) {
					die($e->getMessage());
				}
			?>
        	<? foreach($categories as $cat) : ?>
                <a href="news.php?id=<?=$cat->getId(); ?>"><div><?=$cat->getTitle(); ?></div></a>
            <? endforeach; ?>
        </div>
    </div>
    
    <div class="<?= ($page == "committees") ? "active" : "";  ?>">
        <a href="committees.php" class="navButton">
            <div>
                Комитеты
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden">
        	<?php
				require_once("packages/info/mapper/CommitteesMapper.php");
				require_once("packages/info/domain/Committees.php");
				$comMapper = new \info\mapper\CommitteesMapper($pdo);
				try {
					$committees = $comMapper->findAll();
				} catch (Exception $e) {
					die($e->getMessage());
				}
			?>
            <? foreach($committees as $comm) : ?>
	            <a href="committees.php?id=<?=$comm->getId(); ?>"><div><?=$comm->getTitle(); ?></div></a>
            <? endforeach; ?>
        </div>
    </div>
    
    <div class="<?= ($page == "about") ? "active" : "";  ?>">
        <a href="#" class="navButton">
            <div>
                О Союзе
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden"></div>
    </div>
    
    <div class="<?= ($page == "applicationForm") ? "active" : "";  ?>">
        <a href="applicationForm.php" class="navButton">
        	<div>Регистрация в Союзе</div>
		</a>
        <div class="hidden"></div>
    </div>
</nav>