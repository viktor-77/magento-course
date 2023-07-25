<?php declare(strict_types=1);

namespace Umanskiy\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Umanskiy\Blog\Api\Data\PostInterface;
use Umanskiy\Blog\Model\CategoryRepository;
use Umanskiy\Blog\Model\PostRepository;
use Umanskiy\Blog\Model\TagRepository;

class BlogInitialData implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private TagRepository $tagRepository;
    private CategoryRepository $categoryRepository;
    private PostRepository $postRepository;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param TagRepository $tagRepository
     * @param CategoryRepository $categoryRepository
     * @param PostRepository $postRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        TagRepository            $tagRepository,
        CategoryRepository       $categoryRepository,
        PostRepository           $postRepository
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function apply(): void
    {
        $setup = $this->moduleDataSetup;
        $setup->startSetup();

        for ($i = 1; $i <= 5; $i++) {
            $this->tagRepository->save('tag_' . $i);

            $this->categoryRepository->save('category_' . $i);

            $this->postRepository->save([
                PostInterface::THUMBNAIL => 'thumbnail_' . $i,
                PostInterface::TITLE => 'title_' . $i,
                PostInterface::SHORT_TEXT => 'short_text_' . $i,
                PostInterface::CATEGORY_ID => $i,
                PostInterface::TAG_IDS => $i,
            ]);
        }

        $setup->endSetup();
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases(): array
    {
        return [];
    }
}
