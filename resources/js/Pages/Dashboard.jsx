import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';

export default function Dashboard({auth}) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard"/>

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
            </div>
        </AuthenticatedLayout>
    );
}
