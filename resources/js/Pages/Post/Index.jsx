import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from "@inertiajs/react";

export default function Index({auth, userPosts}) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
            }
        >
            <Head title="Posts"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Link
                        tabIndex="1"
                        className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                        href={route("posts.create")}
                    >
                        Create New Post
                    </Link>
                </div>
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <table className="w-full whitespace-nowrap">
                        <thead className="text-white bg-gray-600">
                        <tr className="font-bold text-left">
                            <th>#</th>
                            <th>Title</th>
                            <th>CreatedAt</th>
                            <th>Rates</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {userPosts.map(({
                                            id, title, created_at, likes, dislikes
                                        }) => (
                            <tr key={id} className="">
                                <td>
                                    <Link
                                        href={route("posts.edit", id)}
                                        className="flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none"
                                    >
                                        {id}
                                    </Link>
                                </td>
                                <td>
                                    <Link
                                        href={route("posts.edit", id)}
                                        className="flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none"
                                    >
                                        {title}
                                    </Link>
                                </td>
                                <td>
                                    {new Date(created_at).toLocaleString()}
                                </td>
                                <td>
                                    Like: {likes} / Dislike: {dislikes}
                                </td>
                                <td>
                                    <Link
                                        tabIndex="1"
                                        className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                        href={route("posts.edit", id)}
                                    >
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

