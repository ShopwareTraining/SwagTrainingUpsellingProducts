<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Entity;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(name: 'shopware.entity.definition', attributes: ['entity' => 'product_upselling'])]
class UpsellingDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'product_upselling';
    }

    public function getEntityClass(): string
    {
        return UpsellingEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required(), new ApiAware()),
            (new FkField('product_id', 'productId', ProductDefinition::class, 'id'))->addFlags(new Required(), new ApiAware()),
            (new FkField('upselling_product_id', 'upsellingProductId', ProductDefinition::class))->addFlags(new Required(), new ApiAware()),
            new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id'),
            new OneToOneAssociationField('upsellingProduct', 'upselling_product_id', 'id', ProductDefinition::class)
        ]);
    }
}
