import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link, useForm} from "@inertiajs/react";

export default function Index({auth}) {
    const {data, setData, errors, post} = useForm({
        title: "",
        short_desc: "",
        desc: "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        post(route("posts.store"));
    }

    return (<AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
            }
        >
            <Head title="Create New Post"/>
            <div className="py-12">
                <div className="container flex flex-col justify-center mx-auto">
                    <div>
                        <h1 className="mb-8 text-3xl font-bold">
                            <Link
                                href={route("posts.index")}
                                className="text-indigo-600 hover:text-indigo-700"
                            >
                                Posts
                            </Link>
                            <span className="font-medium text-indigo-600"> / </span>
                            Create
                        </h1>
                    </div>
                    <div className="max-w-6xl p-8 bg-white rounded shadow">
                        <form name="createForm" onSubmit={handleSubmit}>
                            <div className="flex flex-col">
                                <div className="mb-4">
                                    <label className="">Title</label>
                                    <input
                                        type="text"
                                        className="w-full px-4 py-2"
                                        label="Title"
                                        name="title"
                                        value={data.title}
                                        onChange={(e) =>
                                            setData("title", e.target.value)
                                        }
                                    />
                                    <span className="text-red-600">
                                    {errors.title}
                                </span>
                                </div>
                                <div className="mb-0">
                                    <label className="">Short Description</label>
                                    <textarea
                                        type="text"
                                        className="w-full rounded"
                                        label="short_desc"
                                        name="short_desc"
                                        errors={errors.short_desc}
                                        value={data.short_desc}
                                        onChange={(e) =>
                                            setData("short_desc", e.target.value)
                                        }
                                    />
                                    <span className="text-red-600">
                                    {errors.short_desc}
                                </span>
                                </div>
                                <div className="mb-0">
                                    <label className="">Description</label>
                                    <textarea
                                        type="text"
                                        className="w-full rounded"
                                        label="description"
                                        name="description"
                                        errors={errors.desc}
                                        value={data.desc}
                                        onChange={(e) =>
                                            setData("desc", e.target.value)
                                        }
                                    />
                                    <span className="text-red-600">
                                    {errors.desc}
                                </span>
                                </div>
                            </div>
                            <div className="mt-4">
                                <button
                                    type="submit"
                                    className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
