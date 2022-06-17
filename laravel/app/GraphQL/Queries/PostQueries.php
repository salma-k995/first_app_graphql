<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;

use App\Models\Post;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

use function Safe\error_log;

final class PostQueries
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    function posts($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return Post::query();
    }


    function postComments($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $post = Post::findOrFail($args['id']);
        $post_info =  $post->comments()->get();
       return  $post_info;

    }
}
