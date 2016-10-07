<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <ul>
        <?php
        function getMenu()
        {
            return require 'menu.php';
        }
        $menu = getMenu();
        foreach ($menu as $item):
            switch ($item['name']) {
                case 'Categories':
                    $icon = '[categories icon]';
                    break;
                case 'Contacts':
                    $icon = '[contacts icon]';
                    break;
                default:
                    $icon = '[default icon]';
                    break;
            }

            $title = !empty($item['title'])
                ? "title=\"{$item['title']}\""
                : '';
        ?>

            <li>
                <?= $icon ?>
                <a href="<?= $item['url'] ?>" <?= $title ?>>
                    <?= $item['name'] ?>
                </a>
                <?php if (!empty($item['items'])): ?>
                <ul>
                    <?php foreach ($item['items'] as $subItem): ?>
                    <li>
                        <a href="<?= $item['url'] . $subItem['url'] ?>">
                            <?= $subItem['name'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li> 
        <?php endforeach; ?>


        <?php var_dump($title); ?>
            </ul>
        </nav>
    </header>
</body>
</html>