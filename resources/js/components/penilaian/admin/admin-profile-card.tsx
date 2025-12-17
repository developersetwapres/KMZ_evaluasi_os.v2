import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Link } from '@inertiajs/react';
import { Building2, User } from 'lucide-react';

interface UserData {
    name: string;
    email: string;
    jabatan: string;
    unit_kerja: string;
}

interface AdminProfileCardProps {
    user: UserData;
}

export function AdminProfileCard({ user }: AdminProfileCardProps) {
    return (
        <Card className="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <CardHeader>
                <div className="flex items-center space-x-4">
                    <div className="rounded-full bg-white/20 p-3">
                        <User className="h-8 w-8 text-white" />
                    </div>
                    <div>
                        <CardTitle className="text-2xl text-white">
                            {user.name}
                        </CardTitle>
                        <CardDescription className="text-blue-100">
                            {user.jabatan} • {user.unit_kerja}
                        </CardDescription>
                    </div>
                </div>
            </CardHeader>
            <CardContent>
                <div className="grid gap-4 text-sm md:grid-cols-2">
                    <div className="space-y-2">
                        <div className="flex items-center space-x-2">
                            <span className="font-medium">Email:</span>
                            <span>{user.email}</span>
                        </div>
                        <div className="flex items-center space-x-2">
                            <span className="font-medium">Role:</span>
                            <span>System Administrator</span>
                        </div>
                    </div>
                    <div className="space-y-2">
                        <div className="flex items-center space-x-2">
                            <Building2 className="h-4 w-4" />
                            <span>{user.unit_kerja}</span>
                        </div>
                        <div className="flex items-center space-x-2">
                            <span className="font-medium">Akses:</span>
                            <Link
                                href="/admin/profile"
                                className="underline hover:text-blue-100"
                            >
                                Full System Access
                            </Link>
                        </div>
                    </div>
                </div>
            </CardContent>
        </Card>
    );
}
