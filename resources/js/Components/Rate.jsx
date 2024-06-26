import {useForm} from "@inertiajs/react";

export default function Rate({user, id, type, like, dislike}) {
    const url = type === 'post' ? route('rank.createPostRank') : route('rank.createCommentRank');
    const {data, setData, errors, post} = useForm({
        entity_id: id,
        isLike: "",
    });

    async function sendRank(isLike) {
        if (user) {
            data.isLike = isLike;
            post(url);
        } else {
            alert('please login first');
        }
    }

    return (

        <div>
            <div className="flex items-center justify-between text-slate-500">
                <div className="flex space-x-4 md:space-x-8">
                    <div onClick={() => sendRank(false)}
                         className="flex cursor-pointer items-center transition hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             className="mr-1.5 h-5 w-5 scale-y-[-1]" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                        </svg>
                        <span>{dislike}</span>
                    </div>
                    <div onClick={() => sendRank(true)}
                         className="flex cursor-pointer items-center transition hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             className="mr-1.5 h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                        </svg>
                        <span>{like}</span>
                    </div>
                </div>
            </div>
        </div>

    );
}
