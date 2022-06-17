<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
final class ImageMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }
    public function upload ($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)  {
        $file=$args['file'];

        $file->storePublicly('uploads');
        return"uploded";
    }

}
