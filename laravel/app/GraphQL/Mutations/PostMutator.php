<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class PostMutator
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    function postCreate($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->request->user();
        $post = $user->posts()->create($args['input']);
        return $post;
    }

    function commentCreate($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $post = Post::findOrFail($args['id']);
        $post=$post->comments()->create($args['input']);
        return $post;
    }
}
