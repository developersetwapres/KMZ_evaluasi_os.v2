"use client"

import { Settings, LogOut } from "lucide-react"
import { Button } from "@/components/ui/button"

interface AdminHeaderProps {
  onLogout?: () => void
}

export function AdminHeader({ onLogout }: AdminHeaderProps) {
  const handleLogout = () => {
    if (onLogout) {
      onLogout()
    }
    // Default logout behavior
    console.log("Logging out...")
  }

  return (
    <header className="border-b bg-white shadow-sm">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between py-4">
          <div className="flex items-center space-x-3">
            <div className="rounded-lg bg-blue-600 p-2">
              <Settings className="h-6 w-6 text-white" />
            </div>
            <div>
              <h1 className="text-xl font-bold text-gray-900">Dashboard Administrator</h1>
              <p className="text-sm text-gray-500">Sistem Penilaian Kinerja Outsourcing</p>
            </div>
          </div>
          <Button
            variant="outline"
            onClick={handleLogout}
            className="flex items-center space-x-2 bg-transparent hover:border-red-200 hover:bg-red-50 hover:text-red-600"
          >
            <LogOut className="h-4 w-4" />
            <span>Logout</span>
          </Button>
        </div>
      </div>
    </header>
  )
}
